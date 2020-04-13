@extends('layouts.ready')

@section('styles')
<style>
    .product-item .card-body {
        position: relative;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header py-2">All Products</div>
            <div class="card-body p-2">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <div class="list-group">
                            <a class="list-group-item rounded-0 active" href="#">Cras justo odio</a>
                            <a class="list-group-item list-group-item-action" href="#">Dapibus ac facilisis in</a>
                            <a class="list-group-item list-group-item-action" href="#">Morbi leo risus</a>
                            <a class="list-group-item list-group-item-action" href="#">Porta ac consectetur ac</a>
                            <a class="list-group-item rounded-0 list-group-item-action" href="#">Vestibulum at eros</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-8 col-xl-9">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-md-6 col-lg-4">
                                <div class="product-item">
                                    <div class="card rounded-0 shadow-sm">
                                        <img class="card-img-top p-2" src="https://fleetcart.envaysoft.com/storage/media/ieaRDnJgWqOBvGNrcUoRWBcsqXtBrpWIckKo7sWl.jpeg" alt="Product Image">
                                        <div class="card-body">
                                            <div class="overlay">
                                                slfj
                                            </div>
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection