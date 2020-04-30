<div class="card rounded-0 shadow-sm">
    <div class="card-header">Py To <strong>{{ $reseller->name }}</strong></div>
    <div class="card-body">
        <form action="{{ route('admin.transactions.pay.store') }}" method="post">
            @csrf
            <h4 class="text-center">Balance: {{ $balance }}</h4>
            <input type="hidden" name="reseller_id" value="{{ $reseller->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" name="amount" wire:model.debounce.250ms="amount" wire:keyup="calc" value="{{ old('amount', $amount) }}" class="form-control @error('amount') is-invalid @enderror">
                        @error('amount')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="method">Method</label>
                        <!-- <input type="text" name="method" wire:model.debounce.250ms="method" value="{{ old('method', $method) }}" class="form-control @error('method') is-invalid @enderror"> -->
                        <select name="method" wire:model.debounce.250ms="method" wire:change="chMethod" class="form-control @error('method') is-invalid @enderror">
                            <option value="">Select Method</option>    
                            @foreach($reseller->payment as $payment)
                            <option value="{{ $payment->method }}">{{ $payment->method }}</option>
                            @endforeach
                        </select>
                        @error('method')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input type="text" name="account_number" value="{{ old('account_number', $number) }}" class="form-control @error('account_number') is-invalid @enderror">
                        @error('account_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transaction_number">Transaction Number</label>
                        <input type="text" name="transaction_number" value="{{ old('transaction_number') }}" class="form-control @error('transaction_number') is-invalid @enderror">
                        @error('transaction_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-success ml-auto d-block">Pay</button>
        </form>
    </div>
</div>