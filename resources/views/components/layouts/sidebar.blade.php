<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @foreach($menu as $single)
                @switch($single['style'])
                    @case('title')
                    <li class="nav-title">{{ $single['name'] }}</li>
                    @break
                    @case('dropdown')
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                            <i class="nav-icon {{ $single['icon'] ?? '' }}"></i> {{ $single['name'] }}
                                @if(array_key_exists('badge', $single))
                                <span class="badge badge-{{ $single['badge']['variant'] ?? 'primary' }}">{{ $single['badge']['data'] }}</span>
                                @endif
                            </a>
                        <ul class="nav-dropdown-items">
                            @foreach($single['items'] as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ isset($item['route']) ? route($item['route'], $item['param'] ?? []) : (isset($item['url']) ? url($item['url']) : '') }}">
                                    <i class="nav-icon {{ $item['icon'] ?? '' }}"></i> {{ $item['name'] }}
                                    @if(array_key_exists('badge', $item))
                                    <span class="badge badge-{{ $item['badge']['variant'] ?? 'primary' }}">{{ $item['badge']['data'] }}</span>
                                    @endif
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @break
                    @case('simple')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ isset($single['route']) ? route($single['route'], $single['param'] ?? []) : (isset($single['url']) ? url($single['url']) : '') }}">
                            <i class="nav-icon {{ $single['icon'] ?? '' }}"></i> {{ $single['name'] }}
                            @if(array_key_exists('badge', $single))
                            <span class="badge badge-{{ $single['badge']['variant'] ?? 'primary' }}">{{ $single['badge']['data'] }}</span>
                            @endif
                        </a>
                    </li>
                    @break
                @endswitch
            @endforeach
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
