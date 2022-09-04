<ul {{ $attributes }}>
    @foreach($menu as $item)
    <li class="nav-item @if(isset($item["active"]) && $item["active"]) current-menu-item @endif">
        <a class="nav-link" href="{{ url($item['route']) }}">{{ __($item['title']) }}</a>
    </li>
    @endforeach
</ul>
