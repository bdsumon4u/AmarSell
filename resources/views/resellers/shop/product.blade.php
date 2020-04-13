@extends('resellers.shop.layout')

@section('styles')
<style>
    .price-box {
        width: 240px;
        display: flex;
        align-items: center;
        border: 3px double #ddd;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .price-box .left {
        padding: 10px;
        border-right: 3px double #ddd;
        margin-right: 10px;
        width: 60px;
    }
    .price-box .right strong {
        width: 80px;
        display: inline-block;
        font-variant: small-caps;
        font-size: 16px;
    }
    .price-box .right strong + span {
        margin-left: 2px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper clearfix ">
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-inline">
                <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>

                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li class="active">{{ $product->name }}</li>
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
                        <h1 class="product-name">{{ $product->name }}</h1>

                        <div class="code">
                            <label>CODE: </label>
                            <span class="text-uppercase">{{ $product->code }}</span>
                        </div>


                        <div class="clearfix"></div>
                        
                        <div class="price-box">
                            <div class="left">
                                <strong>Price</strong>
                            </div>
                            <div class="right">
                                <ul class="list-unstyled">
                                    <li><strong class="class-info">wholesale</strong>: <span class="text-danger">{{ theMoney($product->wholesale) }}</span></li>
                                    <li><strong class="text-primary">retail</strong>: <span class="text-danger">{{ theMoney($product->retail) }}</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="pull-left">
                            <label>Availability:</label>

                            <span class="in-stock">In Stock</span>
                        </div>

                        <div class="clearfix"><br></div>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}" class="clearfix">
                            @csrf
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