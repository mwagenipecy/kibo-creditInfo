<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\SparePartRequest;
use App\Models\SparePartQuote;
use App\Models\SparePart;
use App\Models\SpareCategory;
use App\Models\SpareBrand;
use App\Models\Make;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SparePartsShop extends Component
{
    public $totalRequests = 0;
    public $pendingRequests = 0;
    public $totalQuotes = 0;
    public $paidQuotes = 0;
    public $pendingQuotes = 0;
    public $totalParts = 0;
    public $lowStockParts = 0;
    public $recentRequests = [];
    public $recentQuotes = [];
    public $topSellingParts = [];
    public $monthlyStats = [];

    public function loadData()
    {
        $shopId = Auth::user()->shop_id ?? 1; // Fallback to 1 if shop_id is null

        // Basic statistics
        $this->totalRequests = SparePartRequest::whereDoesntHave('quotes', function($query) use ($shopId) {
            $query->where('shop_id', $shopId);
        })->count();

        $this->pendingRequests = SparePartRequest::where('status', 'pending')
            ->whereDoesntHave('quotes', function($query) use ($shopId) {
                $query->where('shop_id', $shopId);
            })->count();

        $this->totalQuotes = SparePartQuote::where('shop_id', $shopId)->count();

        $this->paidQuotes = SparePartQuote::where('shop_id', $shopId)
            ->where('status', 'accepted')
            ->count();

        $this->pendingQuotes = SparePartQuote::where('shop_id', $shopId)
            ->where('status', 'pending')
            ->count();

        // Inventory statistics
        $this->totalParts = SparePart::where('shop_id', $shopId)->count();
        $this->lowStockParts = 0; // No stock tracking available with current schema

        // Recent requests (last 5)
        $this->recentRequests = SparePartRequest::with(['make', 'model'])
            ->whereDoesntHave('quotes', function($query) use ($shopId) {
                $query->where('shop_id', $shopId);
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent quotes (last 5)
        $this->recentQuotes = SparePartQuote::with(['sparePartRequest.make', 'sparePartRequest.model'])
            ->where('shop_id', $shopId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Top selling parts (by quote count)
        $this->topSellingParts = SparePartQuote::with('sparePartRequest')
            ->where('shop_id', $shopId)
            ->select('spare_part_request_id', DB::raw('count(*) as quote_count'))
            ->groupBy('spare_part_request_id')
            ->orderBy('quote_count', 'desc')
            ->limit(5)
            ->get();

        // Monthly statistics for the last 6 months (quotes only)
        $this->monthlyStats = SparePartQuote::where('shop_id', $shopId)
        ->where('created_at', '>=', now()->subMonths(6))
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as quote_count')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();
    }

    public function render()
    {
        $this->loadData();
        
        return view('livewire.dashboard.spare-parts-shop');
    }
}
