<div class="checkout-content">
    <h2>Delivery Information</h2>
    <div class="form-group">
        <label for="delivery_method">Delivery Method</label>
        <select class="form-control" id="delivery_method" name="delivery_method">
            <option value="">Select Delivery Method</option>
            <option value="Pathao">Pathao</option>
            <option value="Self">Self Delivery</option>
        </select>
    </div>

    <div class="form-group" style="display: none;">
        <label for="city">City</label>
        <select class="form-control" id="city" name="city">
            <option value="">Select City</option>
        </select>
    </div>

    <div class="form-group" style="display: none;">
        <label for="zone">Zone</label>
        <select class="form-control" id="zone" name="zone">
            <option value="">Select Zone</option>
        </select>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/checkout-address.js') }}"></script>
@endpush
