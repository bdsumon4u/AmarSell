@extends('resellers.shop.layout')

@section('content')
<div class="row">
    <div class="cart-list-wrapper clearfix">
        @if ($cart->isEmpty())
            <h2 class="text-center">Your Cart is Empty!</h2>
        @else
            <div class="col-md-8">
                <div class="box-wrapper clearfix">
                    <div class="box-header">
                        <h4>Cart Items</h4>
                    </div>

                    <div class="cart-list">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @foreach ($cart as $cartItem)
                                        <tr class="cart-item">
                                            <td>
                                                img
                                            </td>

                                            <td>
                                                <h5>
                                                    <a href="{{ route('products.show', $cartItem->attributes->product->slug) }}">{{ $cartItem->name }}</a>
                                                </h5>
                                            </td>

                                            <td>
                                                <div class="pull-left" style="margin: 10px;">
                                                    <label><strong class="badge badge-secondary">Price:</strong></label>
                                                    <ul class="list-unstyled">
                                                        <li><strong class="text-info">Wholesale:</strong> <span>{{ theMoney($cartItem->price) }}</span></li>
                                                        <li><strong class="text-primary">Retail:</strong> <span>{{ theMoney($cartItem->attributes->product->retail_price) }}</span></li>
                                                    </ul>
                                                </div>
                                                <div class="pull-left" style="margin: 10px;">
                                                    <label for=""><strong class="badge badge-secondary">Quantity:</strong></label>
                                                    <br>
                                                    <div class="quantity pull-left clearfix">
                                                        <div class="input-group-quantity pull-left clearfix">
                                                            <input type="text" name="qty" value="{{ $cartItem->quantity }}" class="input-number input-quantity pull-left {{ "qty-{$loop->index}"  }}" min="1" max="{{ $cartItem->attributes->product->manage_stock ? $cartItem->attributes->product->qty : '' }}">

                                                            <span class="pull-left btn-wrapper">
                                                                <button type="button" class="btn btn-number btn-plus" data-type="plus"> + </button>
                                                                <button type="button" class="btn btn-number btn-minus" data-type="minus" {{ $cartItem->qty === 1 ? 'disabled' : '' }}> &#8211; </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="clearfix">
                                                
                                            </td>

                                            <td></td>
                                            <td></td>

                                            <td>
                                                <form method="POST" action="{{ route('cart.remove', $cartItem->id) }}" onsubmit="return confirm('Are Your Sure To Remove It?');">
                                                    @csrf
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn-close" data-toggle="tooltip" data-placement="top" title="Remove">
                                                        &times;
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="order-review cart-list-sidebar">
                    <form action="{{ route('cart.checkout') }}" method="post" class="cart-total">
                        @csrf
                        <h3>Cart Totals</h3>

                        <span class="item-amount">
                            Cart Subtotal
                            <span>{{ theMoney(Cart::getSubTotal()) }}</span>
                        </span>

                        <span>
                            <div class="form-group shipping-charge">
                                <label for="shipping-charge">Shipping Charge: </label>
                                <input type="number" name="shipping_charge" value="{{ old('shipping_charge', 100) }}" id="shipping-charge" onclick="$(this).select();">
                            </div>
                        </span>

                        <span>
                            <div class="form-group advanced">
                                <label for="advanced">Advanced: </label>
                                <input type="number" name="advanced" value="{{ old('advanced', 100) }}" id="advanced" onclick="$(this).select();">
                            </div>
                        </span>

                        <span class="total">
                            Payable
                            <span id="total-amount">{{ theMoney(Cart::getTotal()) }}</span>
                        </span>

                        <button type="submit" class="btn btn-primary btn-checkout" data-loading>
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection