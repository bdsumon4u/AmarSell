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
            <div class="card-header py-2">All <strong>Products</strong></div>
            <div class="card-body p-2">
                <div class="row justify-content-center">
                    @foreach($products as $product)
                    <div class="col-md-4 col-lg-3 products">
                        <div class="product-item">
                            <div class="card rounded-0 shadow-sm">
                                <img class="card-img-top p-2" src="{{ $product->base_image }}" alt="Base Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Details</a>
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
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#cat-tog').click(function() {
            if($('.categories').hasClass('d-md-block')) {
                $('.categories').removeClass('d-md-block').addClass('d-none');
                $('.products').addClass('col-sm-6');
            }
            else if($('.categories').hasClass('d-none')) {
                $('.categories').removeClass('d-none').addClass('d-md-block');
                $('.products').removeClass('col-sm-6');
            }
        });
    });
</script>
@endsection