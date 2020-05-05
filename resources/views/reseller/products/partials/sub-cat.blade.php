
<ul>
    @foreach($categories as $category)
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