<aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
        @foreach($asideTab as $tab)
        <li class="nav-item">
            <a class="nav-link {{ $loop->index ? '' : 'active' }}" data-toggle="tab" href="#{{ $tab['id'] }}" role="tab">
                {{ $tab['title'] }}
            </a>
        </li>
        @endforeach
    </ul>
    <!-- Tab panes-->
    <div class="tab-content">
        @foreach($asideTab as $tab)
        <div class="tab-pane {{ $loop->index ? '' : 'active' }}" id="{{ $tab['id'] }}" role="tabpanel">
            @include($tab['view'])
        </div>
        @endforeach
    </div>
</aside>