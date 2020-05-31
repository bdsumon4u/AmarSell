
<h3>Cart Totals</h3>

    <span class="item-amount">
        <label for="">Buy Price</label>
        <span>{{ $subTotal }}</span>
    </span>

    <span>
        <div class="form-group charge-box">
            <label for="sell-price">Sell Price: </label>
            <input type="number" name="sell" value="{{ old('sell', $sell) }}" id="sell-price" wire:model.debounce.250ms="sell" wire:keyup="changed" onfocus="$(this).select();">
        </div>
    </span>
        <div class="form-group charge-box">
            <label for="shipping-charge">Shipping Cost: </label>
            <input type="number" name="shipping" value="{{ old('shipping', $shipping) }}" id="shipping-charge" wire:model.debounce.250ms="shipping" wire:keyup="changed" onfocus="$(this).select();">
        </div>
    </span>
    <span>
        <div class="form-group charge-box">
            <label for="advanced">Advanced: </label>
            <input type="number" name="advanced" value="{{ old('advanced', $advanced) }}" id="advanced" wire:model.debounce.250ms="advanced" wire:keyup="changed" onfocus="$(this).select();">
        </div>
    </span>

    <span class="total">
        Payable
        <span id="total-amount">{{ $payable }}</span>
    </span>