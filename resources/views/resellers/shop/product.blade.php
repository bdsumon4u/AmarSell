@extends('resellers.shop.layout')

@section('content')
<div class="content-wrapper clearfix ">
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-inline">
                <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>

                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li class="active">{{ $product->title }}</li>
            </ul>
        </div>


        <div class="product-details-wrapper">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-5 col-xs-7">
                    <div class="product-image">
                        <div class="base-image">
                            <a class="base-image-inner"
                                href="https://fleetcart.envaysoft.com/storage/media/WqFQAxS9QIf4pRVDcMRqRgR6GUTbuaQD0Zj1736H.jpeg">
                                <img src="https://fleetcart.envaysoft.com/storage/media/WqFQAxS9QIf4pRVDcMRqRgR6GUTbuaQD0Zj1736H.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                                <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </a>
                            <a class="base-image-inner"
                                href="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg">
                                <img src="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                                <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </a>
                            <a class="base-image-inner"
                                href="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg">
                                <img src="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                                <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </a>
                            <a class="base-image-inner"
                                href="https://fleetcart.envaysoft.com/storage/media/44cIVlsBGSil719QwRuSpHJsAvvgtP03HyBfAbPv.jpeg">
                                <img src="https://fleetcart.envaysoft.com/storage/media/44cIVlsBGSil719QwRuSpHJsAvvgtP03HyBfAbPv.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                                <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </a>
                            <a class="base-image-inner"
                                href="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg">
                                <img src="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                                <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </a>
                            <a class="base-image-inner"
                                href="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg">
                                <img src="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                                <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                            </a>
                        </div>

                        <div class="additional-image">
                            <div class="thumb-image slick-slide slick-current slick-active">
                                <img src="https://fleetcart.envaysoft.com/storage/media/WqFQAxS9QIf4pRVDcMRqRgR6GUTbuaQD0Zj1736H.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                            </div>
                            <div class="thumb-image">
                                <img src="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                            </div>
                            <div class="thumb-image">
                                <img src="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                            </div>
                            <div class="thumb-image">
                                <img src="https://fleetcart.envaysoft.com/storage/media/44cIVlsBGSil719QwRuSpHJsAvvgtP03HyBfAbPv.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                            </div>
                            <div class="thumb-image">
                                <img src="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                            </div>
                            <div class="thumb-image">
                                <img src="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg"
                                    alt="Eastpak Unisex Provider Backpack - Navy">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                    <div class="product-details">
                        <h1 class="product-name">{{ $product->title }}</h1>

                        <div class="sku">
                            <label>SKU: </label>
                            <span class="text-uppercase">{{ $product->sku }}</span>
                        </div>


                        <div class="clearfix"><br></div>
                        
                        <ul class="list-unstyled">
                            <li><strong class="class-info">Wholesale Price:</strong> <span class="text-danger">{{ $product->wholesale_price }}</span></li>
                            <li><strong class="text-primary">Retail Price:</strong> <span class="text-danger">{{ $product->retail_price }}</span></li>
                        </ul>

                        <div class="clearfix"><br></div>

                        <div class="pull-left">
                            <label>Availability:</label>

                            <span class="in-stock">In Stock</span>
                        </div>

                        <div class="clearfix"><br></div>

                        <form method="POST" action="https://fleetcart.envaysoft.com/en/cart/items" class="clearfix">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="product-variants clearfix">
                            </div>

                            <div class="quantity pull-left clearfix">
                                <label class="pull-left" for="qty">Qty</label>

                                <div class="input-group-quantity pull-left clearfix">
                                    <input type="text" name="qty" value="1"
                                        class="input-number input-quantity pull-left" id="qty" min="1" max="">

                                    <span class="pull-left btn-wrapper">
                                        <button type="button" class="btn btn-number btn-plus" data-type="plus"> +
                                        </button>
                                        <button type="button" class="btn btn-number btn-minus" data-type="minus"
                                            disabled=""> – </button>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="add-to-cart btn btn-primary pull-left" data-loading="">
                                Add to cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="tab product-tab clearfix">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#description">Description</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="description" class="description tab-pane fade in active">
                                {!! nl2br($product->description) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="landscape-products-wrapper">
            <div class="section-header">
                <h3>You might also like</h3>
            </div>

            <div class="row">
                <div class="landscape-products slick-arrow separator">
                    @for($i = 1; $i <= 10; $i++)
                    <div class="col-md-4">
                        <a href="https://fleetcart.envaysoft.com/en/products/hugo-boss-fashion-backpack-for-men-black"
                            class="single-product">
                            <div class="image-holder">
                                <img src="https://fleetcart.envaysoft.com/storage/media/euc7RDGSB39bRrgQltRV3Gkc2pSn5gCVZbdJdem7.jpeg"
                                    alt="Hugo Boss Fashion Backpack For Men - Black">
                            </div>

                            <div class="single-product-details">
                                <span class="product-name">Hugo Boss Fashion Backpack For Men -
                                    Black</span>

                                <span class="product-price">
                                    $70.00 <span class="previous-price">$82.00</span>
                                </span>
                            </div>
                        </a>
                    </div>
                    @endfor
                </div>
            </div>
        </section>
    </div>
</div>
@endsection