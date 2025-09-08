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
        // Strictly scope to the authenticated user's shop. If none, return empty stats to avoid leakage.
        $shopId = Auth::user()->shop_id ?? 0;

        if (!$shopId) {
            $this->totalRequests = 0;
            $this->pendingRequests = 0;
            $this->totalQuotes = 0;
            $this->paidQuotes = 0;
            $this->pendingQuotes = 0;
            $this->totalParts = 0;
            $this->lowStockParts = 0;
            $this->recentRequests = collect();
            $this->recentQuotes = collect();
            $this->topSellingParts = collect();
            $this->monthlyStats = collect();
            return;
        }

        // Basic statistics (global, not bound to shop)
        $this->totalRequests = SparePartRequest::count();

        $this->pendingRequests = SparePartRequest::where('status', 'pending')->count();

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

        // Recent requests (last 5) - global view, not bound to shop
        $this->recentRequests = SparePartRequest::with(['make:id,name', 'model:id,name'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent quotes (last 5)
        $this->recentQuotes = SparePartQuote::with([
                'sparePartRequest:id,make_id,model_id,created_at',
                'sparePartRequest.make:id,name',
                'sparePartRequest.model:id,name'
            ])
            ->where('shop_id', $shopId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Top selling parts (by quote count)
        $this->topSellingParts = SparePartQuote::with('sparePartRequest:id')
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
