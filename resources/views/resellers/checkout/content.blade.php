<section class="checkout">
    <form method="POST" action="{{ route('order.store') }}" id="checkout-form">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="wizard">
                    <div id="" class="" role="tabpanel">
                        <div class="box-wrapper address clearfix">
                            <div class="box-header">
                                <h4>Checkout Information</h4>
                            </div>

                            <div class="personal-information clearfix">
                                <h5>Customer Info</h5>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('customer_email') ? 'has-error': '' }}">
                                        <label for="customer-email">
                                            Email
                                        </label>

                                        <input type="text" name="customer_email" class="form-control" id="customer-email" value="{{ old('customer_email') }}">

                                        {!! $errors->first('customer_email', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('customer_phone') ? 'has-error': '' }}">
                                        <label for="customer-phone">
                                            Phone<span>*</span>
                                        </label>

                                        <input type="text" name="customer_phone" class="form-control" id="customer-phone" value="{{ old('customer_phone') }}">

                                        {!! $errors->first('customer_phone', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('customer_address') ? 'has-error': '' }}">
                                        <label for="customer-address">
                                            Address<span>*</span>
                                        </label>

                                        <input type="text" name="customer_address" class="form-control" id="customer-address" value="{{ old('customer_address') }}">

                                        {!! $errors->first('customer_address', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="personal-information clearfix">
                                <br>
                                <h5>Order Info</h5>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('shop') ? 'has-error': '' }}">
                                        <label for="reseller-shop">
                                            Select Shop
                                        </label>

                                        <input type="text" name="shop" class="form-control" id="reseller-shop" value="{{ old('shop') }}">

                                        {!! $errors->first('shop', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('delevary_method') ? 'has-error': '' }}">
                                        <label for="delevary-method">
                                            Delevary Method<span>*</span>
                                        </label>

                                        <input type="text" name="delevary_method" class="form-control" id="delevary-method" value="{{ old('delevary_method') }}">

                                        {!! $errors->first('delevary_method', '<span class="error-message">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="personal-information clearfix">
                                <br>
                                <h5>Cart List</h5>
                                <div class="cart-list">
                                    @include('resellers.cart.table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="checkout-sidebar order-review">
                    <div class="cart-total">
                        @include('resellers.cart.sidebar')
                        @method('POST')
                        <button type="submit" class="btn btn-primary btn-checkout" data-loading>
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>