<div class="sidebar">
    <ul class="sidebar-content clearfix">
        @foreach(App\Category::formatted() as $category)
            <li class="">
                <a href="{{ route('reseller.product.by-category', [$category->slug, $category->id]) }}">
                    {{ $category->name }}
                </a>
                @includeUnless($category->childrens->isEmpty(), 'reseller.products.partials.sub-cat', ['categories' => $category->childrens, 'liclass' => 'submenu'])
            </li>
        @endforeach
    </ul>
    @menu('header-menu')
</div>