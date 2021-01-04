
<h3>Cart Totals</h3>

<span class="item-amount">
    <label for="">Buy Price</label>
    <span>{{ $subTotal }}</span>
</span>

<span>
    <div class="charge-box @error('sell') has-error @enderror">
        <label for="sell-price">Sell Price: <span>*</span></label>
        <input type="number" name="sell" value="{{ old('sell', $sell) }}" id="sell-price" onfocus="$(this).select();">
    </div>
    {!! $errors->first('sell', '<span class="error-message" style="margin-top: 0; margin-bottom: .5rem;">:message</span>') !!}
</span>
    <div class="charge-box @error('shipping') has-error @enderror">
        <label for="shipping-charge">Shipping Cost: <span>*</span></label>
        <input type="number" name="shipping" value="{{ old('shipping', $shipping) }}" id="shipping-charge" onfocus="$(this).select();">
    </div>
    {!! $errors->first('shipping', '<span class="error-message" style="margin-top: 0; margin-bottom: .5rem;">:message</span>') !!}
</span>
<span>
    <div class="charge-box @error('advanced') has-error @enderror">
        <label for="advanced">Advanced: <span>*</span></label>
        <input type="number" name="advanced" value="{{ old('advanced', $advanced) }}" id="advanced" onfocus="$(this).select();">
    </div>
    {!! $errors->first('advanced', '<span class="error-message" style="margin-top: 0; margin-bottom: .5rem;">:message</span>') !!}
</span>