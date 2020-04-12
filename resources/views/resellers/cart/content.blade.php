<div class="col-md-8">
    <div class="box-wrapper clearfix">
        <div class="box-header">
            <h4>Cart Items</h4>
        </div>

        <div class="cart-list">
            @include('resellers.cart.table')
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="order-review cart-list-sidebar">
        <form action="{{ route('cart.checkout') }}" method="get" class="cart-total">
            
            @include('resellers.cart.sidebar')

            <button type="submit" class="btn btn-primary btn-checkout" data-loading>
                Checkout
            </button>
        </form>
    </div>
</div>