<?php

namespace App\Http\Controllers;

use App\Models\DataFeed;

class DashboardController extends Controller
{
    public $tab_id;

    /**
     * Displays the dashboard screen
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $this->tab_id = 1;
        $dataFeed = new DataFeed;

        return view('livewire.dashboard.dashboard', compact('dataFeed'));
    }
}
