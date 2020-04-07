@extends('resellers.shop.layout')

@section('content')

<section class="product-list">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            @include('resellers.shop.partials.sidebar')
        </div>

        <div class="col-md-9 col-sm-12">
            <div class="product-list-header clearfix">
                <div class="search-result-title pull-left">
                    <h3>Shop</h3>

                    <span>{{ $products_count }} products found</span>
                </div>

                <div class="search-result-right pull-right">

                    <div class="form-group">
                        <select class="custom-select-black" onchange="location = this.value">
                            <option value="https://fleetcart.envaysoft.com/en/products?sort=relevance">
                                Relevance
                            </option>

                            <option value="https://fleetcart.envaysoft.com/en/products?sort=alphabetic">
                                Alphabetic
                            </option>

                            <option value="https://fleetcart.envaysoft.com/en/products?sort=topRated">
                                Top Rated
                            </option>

                            <option value="https://fleetcart.envaysoft.com/en/products?sort=latest" selected>
                                Latest
                            </option>

                            <option value="https://fleetcart.envaysoft.com/en/products?sort=priceLowToHigh">
                                Price: Low to High
                            </option>

                            <option value="https://fleetcart.envaysoft.com/en/products?sort=priceHighToLow">
                                Price: High to Low
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="product-list-result clearfix">
                <div class="tab-content">
                    <div id="grid-view" class="tab-pane active">
                        <div class="row">
                            <div class="grid-products separator">
                                @foreach($products as $product)
                                <a href="{{ route('shop.product.show', $product->slug) }}"
                                    class="product-card">
                                    <div class="product-card-inner">
                                        <div class="product-image clearfix">
                                            <ul class="product-ribbon list-inline">


                                            </ul>

                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/ieaRDnJgWqOBvGNrcUoRWBcsqXtBrpWIckKo7sWl.jpeg"
                                                    alt="{{ $product->title }}">
                                            </div>
                                        </div>

                                        <div class="product-content clearfix">
                                            <span class="product-price">{{ theMoney($product->wholesale_price) }}</span>
                                            <span class="product-name">{{ $product->title }}</span>
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