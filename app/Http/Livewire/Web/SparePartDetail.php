<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\SparePart;

class SparePartDetail extends Component
{
    public $sparePartId;
    public $sparePart;
    public $selectedImage = 0;
    public $userLatitude = '';
    public $userLongitude = '';
    public $distance = null;

    public function mount($id)
    {
        $this->sparePartId = $id;
        $this->sparePart = SparePart::with(['spareCategory', 'spareBrand', 'spareModel', 'shop'])
            ->findOrFail($id);
    }

    public function selectImage($index)
    {
        $this->selectedImage = $index;
    }

    public function calculateDistance()
    {
        $this->dispatchBrowserEvent('get-user-location-for-distance');
    }

    public function updateUserLocationForDistance($latitude, $longitude)
    {
        $this->userLatitude = $latitude;
        $this->userLongitude = $longitude;
        
        if ($this->sparePart->shop->latitude && $this->sparePart->shop->longitude) {
            $this->distance = $this->haversineDistance(
                $latitude, $longitude,
                $this->sparePart->shop->latitude, $this->sparePart->shop->longitude
            );
        }
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        return round($earthRadius * $c, 2);
    }

    public function render()
    {
        $relatedParts = SparePart::with(['spareCategory', 'shop'])
            ->where('spare_category_id', $this->sparePart->spare_category_id)
            ->where('id', '!=', $this->sparePart->id)
            ->limit(4)
            ->get();

        return view('livewire.web.spare-part-detail', [
            'relatedParts' => $relatedParts
        ]);
    }

    
}