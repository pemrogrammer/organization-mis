<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky py-3 sidebar-sticky">
        @foreach (session('menus')->groupBy('group') as $groupName => $menus)
            <ul class="nav flex-column">
                @if ($groupName)
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>{{ $groupName }}</span>
                        {{-- <a class="link-secondary" href="#" aria-label="Add a new report">
                  <span data-feather="plus-circle" class="align-text-bottom"></span>
                </a> --}}
                    </h6>
                @endif

                @foreach ($menus as $menu)
                    <li class="nav-item">
                        <a class="nav-link {{-- active --}}" {{-- aria-current="page" --}} href="{{ url($menu->path) }}">
                            <i class="bi bi-{{ $menu->bi }}" style="font-size: 1.1rem; padding-right: 0.3rem"></i>
                            {{ $menu->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
</nav>
