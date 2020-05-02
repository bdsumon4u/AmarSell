@extends('reseller.products.layout')

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
        width: 90px;
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


        <div class="row">
            <div class="col-sm-12 col-md-3">
            @include('reseller.products.partials.sidebar')
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="product-details-wrapper">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-7">
                            <div class="product-image">
                                <div class="base-image">
                                    <a class="base-image-inner"
                                        href="{{ $product->base_image }}">
                                        <img src="{{ $product->base_image }}"
                                            alt="Base Image">
                                        <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                    </a>
                                    @foreach($product->additional_images as $path)
                                    <a class="base-image-inner"
                                        href="{{ $path }}">
                                        <img src="{{ $path }}"
                                            alt="Additional Image">
                                        <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                    </a>
                                    @endforeach
                                </div>

                                <div class="additional-image">
                                    <div class="thumb-image slick-slide slick-current slick-active">
                                        <img src="{{ $product->base_image }}"
                                            alt="Base Image">
                                    </div>
                                    @foreach($product->additional_images as $path)
                                    <div class="thumb-image">
                                        <img src="{{ $path }}"
                                            alt="Additional Image">
                                    </div>
                                    @endforeach
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

                                    <span class="in-stock">{!! $product->availability !!}</span>
                                </div>

                                <div class="clearfix"><br></div>

                                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="clearfix">
                                    @csrf
                                    <div class="quantity pull-left clearfix">
                                        <label class="pull-left" for="qty">Qty</label>

                                        <div class="input-group-quantity pull-left clearfix">
                                            <input type="text" name="qty" value="1"
                                                class="input-number input-quantity pull-left" id="qty" min="1" max="{{ $product->stock }}">

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
</div>
@endsection