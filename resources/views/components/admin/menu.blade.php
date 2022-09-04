<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @foreach($menu as $item)
        <li class="nav-item @if(isset($item["active"]) && $item["active"]) menu-open @endif">
            <a href="{{  route($item['route']) }}" class="nav-link @if(isset($item["active"]) && $item["active"]) active @endif">
                <i class="{{ $item['iconClass'] }}"></i>
                <p>
                    {{ $item['title'] }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            @if(isset($item["submenu"]))
            <ul class="nav nav-treeview">
                @foreach($item["submenu"] as $subitem)
                <li class="nav-item">
                    <a href="{{ route($subitem['route']) }}" class="nav-link  @if(isset($subitem["active"]) && $subitem["active"]) active @endif">
                        <i class="{{ $subitem['iconClass'] }}"></i>
                        <p>{{ $subitem['title'] }}</p>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</nav>
