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
                        <div class="base-image slick-initialized slick-slider">
                            <div class="slick-list">
                                <div class="slick-track"
                                    style="opacity: 1; width: 1432px; transform: translate3d(0px, 0px, 0px);"><a
                                        class="base-image-inner slick-slide slick-current slick-active"
                                        href="https://fleetcart.envaysoft.com/storage/media/WqFQAxS9QIf4pRVDcMRqRgR6GUTbuaQD0Zj1736H.jpeg"
                                        data-slick-index="0" aria-hidden="false" style="width: 358px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/WqFQAxS9QIf4pRVDcMRqRgR6GUTbuaQD0Zj1736H.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                        <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                    </a><a class="base-image-inner slick-slide"
                                        href="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg"
                                        data-slick-index="1" aria-hidden="true" tabindex="-1" style="width: 358px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                        <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                    </a><a class="base-image-inner slick-slide"
                                        href="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg"
                                        data-slick-index="2" aria-hidden="true" tabindex="-1" style="width: 358px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                        <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                    </a><a class="base-image-inner slick-slide"
                                        href="https://fleetcart.envaysoft.com/storage/media/44cIVlsBGSil719QwRuSpHJsAvvgtP03HyBfAbPv.jpeg"
                                        data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 358px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/44cIVlsBGSil719QwRuSpHJsAvvgtP03HyBfAbPv.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                        <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                    </a></div>
                            </div>
                        </div>

                        <div class="additional-image slick-initialized slick-slider">
                            <div class="slick-list draggable">
                                <div class="slick-track"
                                    style="opacity: 1; width: 340px; transform: translate3d(0px, 0px, 0px);">
                                    <div class="thumb-image slick-slide slick-current slick-active" data-slick-index="0"
                                        aria-hidden="false" style="width: 75px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/WqFQAxS9QIf4pRVDcMRqRgR6GUTbuaQD0Zj1736H.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                    </div>
                                    <div class="thumb-image slick-slide slick-active" data-slick-index="1"
                                        aria-hidden="false" style="width: 75px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/9VwstoeMcPqKFcI3rHjy4zMTpL5ZHNRFNJMcT2av.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                    </div>
                                    <div class="thumb-image slick-slide slick-active" data-slick-index="2"
                                        aria-hidden="false" style="width: 75px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/mBVIO9T8Y0kwcTqsKwpnAnW86FnTT8PcXc7ElhBV.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                    </div>
                                    <div class="thumb-image slick-slide slick-active" data-slick-index="3"
                                        aria-hidden="false" style="width: 75px;">
                                        <img src="https://fleetcart.envaysoft.com/storage/media/44cIVlsBGSil719QwRuSpHJsAvvgtP03HyBfAbPv.jpeg"
                                            alt="Eastpak Unisex Provider Backpack - Navy">
                                    </div>
                                </div>
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
                <div class="landscape-products slick-arrow separator slick-initialized slick-slider"><button
                        class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous</button>
                    <div class="slick-list draggable">
                        <div class="slick-track"
                            style="opacity: 1; width: 5070px; transform: translate3d(-1170px, 0px, 0px);">
                            <div class="slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/hugo-boss-fashion-backpack-for-men-black"
                                            class="single-product" tabindex="-1">
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
                                </div>
                            </div>
                            <div class="slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/hugo-boss-fashion-backpack-for-men-grey"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/Pxicr27r4nI3YrB6plqB95Cx1rVijtapxcst3DCa.jpeg"
                                                    alt="Hugo Boss Fashion Backpack For Men - Grey">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Hugo Boss Fashion Backpack For Men -
                                                    Grey</span>

                                                <span class="product-price">
                                                    $58.00
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/korean-version-fashion-double-shoulder-bag-backpack-black"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/F8OBSzrsusyLWLtFovV1H0iR26YhjMGaqA5u4BD9.jpeg"
                                                    alt="Korean version fashion double shoulder bag Backpack Black">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Korean version fashion double shoulder bag
                                                    Backpack Black</span>

                                                <span class="product-price">
                                                    $50.00 <span class="previous-price">$62.00</span>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/under-armour-hustle-backpack-Pp3ag9mq"
                                            class="single-product" tabindex="0">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/L3UGUNi6Za2dTHwCb0lLD8pKnrNdA1CqokX5Bjho.jpeg"
                                                    alt="Under Armour Hustle Backpack">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Under Armour Hustle Backpack</span>

                                                <span class="product-price">
                                                    $65.00
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-active" data-slick-index="1" aria-hidden="false"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/the-north-face-unisex-sport-backpack-multi-color"
                                            class="single-product" tabindex="0">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/M6oxpFzvpoHnBFo2i6VPIVw56jOvPxG8WrKfb9Se.jpeg"
                                                    alt="The North Face Unisex Sport Backpack, Multi Color">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">The North Face Unisex Sport Backpack, Multi
                                                    Color</span>

                                                <span class="product-price">
                                                    $56.00
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-active" data-slick-index="2" aria-hidden="false"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/hugo-boss-fashion-backpack-for-men-black"
                                            class="single-product" tabindex="0">
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
                                </div>
                            </div>
                            <div class="slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/hugo-boss-fashion-backpack-for-men-grey"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/Pxicr27r4nI3YrB6plqB95Cx1rVijtapxcst3DCa.jpeg"
                                                    alt="Hugo Boss Fashion Backpack For Men - Grey">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Hugo Boss Fashion Backpack For Men -
                                                    Grey</span>

                                                <span class="product-price">
                                                    $58.00
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide" data-slick-index="4" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/korean-version-fashion-double-shoulder-bag-backpack-black"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/F8OBSzrsusyLWLtFovV1H0iR26YhjMGaqA5u4BD9.jpeg"
                                                    alt="Korean version fashion double shoulder bag Backpack Black">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Korean version fashion double shoulder bag
                                                    Backpack Black</span>

                                                <span class="product-price">
                                                    $50.00 <span class="previous-price">$62.00</span>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-cloned" data-slick-index="5" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/under-armour-hustle-backpack-Pp3ag9mq"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/L3UGUNi6Za2dTHwCb0lLD8pKnrNdA1CqokX5Bjho.jpeg"
                                                    alt="Under Armour Hustle Backpack">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Under Armour Hustle Backpack</span>

                                                <span class="product-price">
                                                    $65.00
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-cloned" data-slick-index="6" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/the-north-face-unisex-sport-backpack-multi-color"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/M6oxpFzvpoHnBFo2i6VPIVw56jOvPxG8WrKfb9Se.jpeg"
                                                    alt="The North Face Unisex Sport Backpack, Multi Color">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">The North Face Unisex Sport Backpack, Multi
                                                    Color</span>

                                                <span class="product-price">
                                                    $56.00
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-cloned" data-slick-index="7" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/hugo-boss-fashion-backpack-for-men-black"
                                            class="single-product" tabindex="-1">
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
                                </div>
                            </div>
                            <div class="slick-slide slick-cloned" data-slick-index="8" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/hugo-boss-fashion-backpack-for-men-grey"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/Pxicr27r4nI3YrB6plqB95Cx1rVijtapxcst3DCa.jpeg"
                                                    alt="Hugo Boss Fashion Backpack For Men - Grey">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Hugo Boss Fashion Backpack For Men -
                                                    Grey</span>

                                                <span class="product-price">
                                                    $58.00
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-cloned" data-slick-index="9" aria-hidden="true" tabindex="-1"
                                style="width: 390px;">
                                <div>
                                    <div class="col-md-4" style="width: 100%; display: inline-block;">
                                        <a href="https://fleetcart.envaysoft.com/en/products/korean-version-fashion-double-shoulder-bag-backpack-black"
                                            class="single-product" tabindex="-1">
                                            <div class="image-holder">
                                                <img src="https://fleetcart.envaysoft.com/storage/media/F8OBSzrsusyLWLtFovV1H0iR26YhjMGaqA5u4BD9.jpeg"
                                                    alt="Korean version fashion double shoulder bag Backpack Black">
                                            </div>

                                            <div class="single-product-details">
                                                <span class="product-name">Korean version fashion double shoulder bag
                                                    Backpack Black</span>

                                                <span class="product-price">
                                                    $50.00 <span class="previous-price">$62.00</span>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Next</button>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection