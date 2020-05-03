@extends('reseller.products.layout')

@section('content')

<section class="product-list">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            @include('reseller.products.partials.sidebar')
        </div>

        <div class="col-md-9 col-sm-12">
            <div class="product-list-header clearfix">
                <div class="search-result-title pull-left">
                    <h3>Shop</h3>

                    <span>{{ $products_count }} products found</span>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="product-list-result clearfix">
                <div class="tab-content">
                    <div id="grid-view" class="tab-pane active">
                        <div class="row">
                            <div class="grid-products separator">
                                @foreach($products as $product)
                                <a href="{{ route('reseller.product.show', $product->slug) }}"
                                    class="product-card">
                                    <div class="product-card-inner">
                                        <div class="product-image clearfix">
                                            <ul class="product-ribbon list-inline">


                                            </ul>

                                            <div class="image-holder">
                                                <img src="{{ $product->base_image }}"
                                                    alt="{{ $product->name }}">
                                            </div>
                                        </div>

                                        <div class="product-content clearfix">
                                            <span class="product-price">{{ theMoney($product->wholesale) }}</span>
                                            <span class="product-name">{{ $product->name }}</span>
                                        </div>

                                        <div class="add-to-actions-wrapper">
                                            

                                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-default btn-add-to-cart">
                                                    Add To Cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                {{ $products->links() }}

            </div>
        </div>
    </div>
</section>
@endsection