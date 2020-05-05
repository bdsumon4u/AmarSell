<div class="product-list-sidebar clearfix">
    <div class="filter-section clearfix">
        <h4>Category</h4>

        <ul class="filter-category list-inline">
            @foreach(App\Category::formatted() as $category)
            <li class="">
                <a href="{{ route('reseller.product.by-category', [$category->slug, $category->id]) }}">
                    {{ $category->name }}
                </a>
                @if(!$category->childrens->isEmpty())
                @include('reseller.products.partials.sub-cat', ['categories' => $category->childrens])
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>