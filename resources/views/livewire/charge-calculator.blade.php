<div class="wizard">
    <form action="{{ route('admin.order.accept', $order->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="shipping">
                        Shipping<span>*</span>
                    </label>

                    <input type="text" name="shipping" class="form-control" id="shipping" value="{{ $shipping }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="advanced">
                        Advanced<span>*</span>
                    </label>

                    <input type="text" name="advanced" class="form-control" id="advanced" value="{{ $advanced }}" readonly>
                </div>
            </div>
            <div class="col-sm-12 box-header">
                <h5><span>Prices</span></h5>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="current-price">
                        Current
                    </label>

                    <input type="text" name="" class="form-control" id="current-price" value="{{ $cp }}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('buy_price') ? 'has-error': '' }}">
                    <label for="buy-price">
                        Buy<span>*</span>
                    </label>

                    <input type="text" name="buy_price" wire:model.debounce.250ms="buy_price" wire:change="changed" class="form-control" id="buy-price" value="{{ old('buy_price') }}">

                    {!! $errors->first('buy_price', '<span class="error-message">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('sell') ? 'has-error': '' }}">
                    <label for="sell-price">
                        Sell<span>*</span>
                    </label>

                    <input type="text" name="sell" wire:model.debounce.250ms="sell" class="form-control" id="sell-price" value="{{ old('sell') }}" readonly>

                    {!! $errors->first('sell', '<span class="error-message">:message</span>') !!}
                </div>
            </div>
            <div class="col-sm-12 box-header">
                <h5><span>Charges</span></h5>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('packaging') ? 'has-error': '' }}">
                    <label for="packaging-charge">
                        Packaging
                    </label>
                    
                    <input type="text" name="packaging" wire:model.debounce.250ms="packaging" wire:change="changed" class="form-control" id="packaging-charge" value="{{ old('packaging', $packaging) }}">
                    
                    {!! $errors->first('packaging', '<span class="error-message">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('delevary_charge') ? 'has-error': '' }}">
                    <label for="delevary-charge">
                        Delevary<span>*</span>
                    </label>

                    <input type="text" name="delevary_charge" wire:model.debounce.250ms="delevary_charge" wire:change="changed" class="form-control" id="delevary-charge" value="{{ old('delevary_charge') }}">

                    {!! $errors->first('delevary_charge', '<span class="error-message">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('cod_charge') ? 'has-error': '' }}">
                    <label for="cod-charge">
                        COD<span>*</span>
                    </label>

                    <input type="text" name="cod_charge" wire:model.debounce.250ms="cod_charge" wire:change="changed" class="form-control" id="cod-charge" value="{{ old('cod_charge', $cod_charge) }}">

                    {!! $errors->first('cod_charge', '<span class="error-message">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('payable') ? 'has-error': '' }}">
                    <label for="payable">
                        Payable
                    </label>

                    <input type="text" name="payable" class="form-control" id="payable" value="{{ old('payable', $payable) }}" readonly>

                    {!! $errors->first('payable', '<span class="error-message">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('profit') ? 'has-error': '' }}">
                    <label for="profit">
                        Profit
                    </label>

                    <input type="text" name="profit" class="form-control" id="profit" value="{{ old('profit', $profit) }}" readonly>

                    {!! $errors->first('profit', '<span class="error-message">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="d-block mt-2 float-right">
            <button type="submit" class="btn btn-success">Accept Order</button>
        </div>
    </form>
</div>