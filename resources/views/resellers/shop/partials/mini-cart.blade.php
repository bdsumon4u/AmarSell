<div class="user-cart pull-right">
    <div class="dropdown">
        <div class="user-cart-inner dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-shopping-bag pull-left" aria-hidden="true"></i>

            <span class="cart-count">{{ $cart->count() }}</span>

            <div class="cart-amount hidden-sm hidden-xs pull-left">
                <span class="cart-label">My Cart</span>
                <br>
                <span class="cart-price">{{ theMoney(Cart::getSubTotal()) }}</span>
            </div>
        </div>

        <div class="dropdown-menu">
            <h5 class="mini-cart-title">My Cart <span class="pull-right"><a href="{{ route('cart.clear') }}" onsubmit="return confirm('Are Your Sure To Clear Cart?');">Clear All</a></span></h5>

            <div class="mini-cart">
                @if ($cart->isEmpty())
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <h3 class="empty-cart">Your Cart is Empty!</h3>
                @else
                    @foreach ($cart as $cartItem)
                        <div class="mini-cart-item clearfix">
                            <div class="mini-cart-image">
                                
                            </div>

                            <div class="mini-cart-details clearfix">
                                <a class="product-name" href="{{ $cartItem->attributes->product->slug }}">
                                    {{ $cartItem->name }}
                                </a>

                                

                                <span class="product-price pull-right">
                                    {{ theMoney($cartItem->price) }}
                                </span>

                                <span class="product-quantity pull-right">
                                    {{ $cartItem->quantity }} *
                                </span>

                                <form method="POST" action="{{ route('cart.remove', $cartItem->id) }}" onsubmit="return confirm('Are Your Sure To Remove It?');">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn-close" data-toggle="tooltip" data-placement="left" title="Remove">
                                        &times;
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            @unless ($cart->isEmpty())
                <span class="subtotal">
                    Subtotal <span>{{ Cart::getSubTotal() }}</span>
                </span>

                <div class="mini-cart-buttons text-center">
                    <a href="{{ route('cart.index') }}" class="btn btn-primary btn-view-cart">
                        View Cart
                    </a>

                    <a href="" class="btn btn-default btn-checkout">
                        Checkout
                    </a>
                </div>
            @endunless
        </div>
    </div>
</div>