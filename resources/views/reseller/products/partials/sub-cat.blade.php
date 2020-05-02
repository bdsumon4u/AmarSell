
<ul>
    @foreach($categories as $category)
    <li class="">
        <a href="https://fleetcart.envaysoft.com/en/products?sort=latest&amp;category=laptops">
            {{ $category->name }}
        </a>
        @if(!$category->childrens->isEmpty())
        @include('reseller.products.partials.sub-cat', ['categories' => $category->childrens])
        @endif
    </li>
    @endforeach
</ul>