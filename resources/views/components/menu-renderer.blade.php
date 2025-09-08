@if($menus && count($menus) > 0)
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            @foreach($menus as $menu)
                <li class="nav-item">
                    @if(isset($submenus[$menu->id]) && count($submenus[$menu->id]) > 0)
                        <!-- Menu with submenus -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-{{ $menu->id }}" aria-expanded="false" aria-controls="submenu-{{ $menu->id }}">
                            @if($menu->menu_icon)
                                <i class="{{ $menu->menu_icon }}"></i>
                            @endif
                            {{ $menu->menu_name }}
                            <i class="fas fa-chevron-down ms-auto"></i>
                        </a>
                        <div class="collapse" id="submenu-{{ $menu->id }}">
                            <ul class="nav flex-column ms-3">
                                @foreach($submenus[$menu->id] as $submenu)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ $submenu->submenu_url }}">
                                            @if($submenu->submenu_icon)
                                                <i class="{{ $submenu->submenu_icon }}"></i>
                                            @endif
                                            {{ $submenu->submenu_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <!-- Menu without submenus -->
                        <a class="nav-link" href="{{ $menu->menu_url }}">
                            @if($menu->menu_icon)
                                <i class="{{ $menu->menu_icon }}"></i>
                            @endif
                            {{ $menu->menu_name }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
@else
    <div class="text-center text-muted py-3">
        <i class="fas fa-lock"></i>
        <p>No accessible menus available</p>
    </div>
@endif
