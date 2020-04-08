@extends('resellers.shop.layout')

@section('styles')
@livewireStyles
@endsection

@section('content')
<div class="row">
    <div class="cart-list-wrapper clearfix">
        @livewire('live-cart', [
            'cart' => $cart->toArray()
        ])
    </div>
</div>
@endsection

@section('scripts')
@livewireScripts
@endsection