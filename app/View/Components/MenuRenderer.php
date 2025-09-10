<?php

namespace App\View\Components;

use App\Services\MenuAccessService;
use Illuminate\View\Component;

class MenuRenderer extends Component
{
    public $menus;
    public $submenus;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menus = MenuAccessService::getAccessibleMenus();
        $this->submenus = [];
        
        // Get submenus for each accessible menu
        foreach ($this->menus as $menu) {
            $this->submenus[$menu->id] = MenuAccessService::getAccessibleSubmenus($menu->id);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-renderer');
    }
}
