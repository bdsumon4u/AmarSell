@section('styles')
@livewireStyles
<style>
    .box-header h5 {
        margin: 0 5px 15px 5px;
    }
    .box-header h5 span {
        border-bottom: 3px double #d9d9d9;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header"><strong>Order Details</strong> <span class="badge my-1 pb-1 text-uppercase badge-{{$variant}} float-right">{{ $order->status }}</span></div>
            <div class="card-body">
                <div class="wizard">
                    <div id="" class="" role="tabpanel">
                        <div class="row box-wrapper address clearfix">
                            <div class="col-sm-12 box-header">
                                <h5><span>Reseller Info</span></h5>
                            </div>
                            @php $reseller = $order->reseller @endphp
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('reseller_name') ? 'has-error': '' }}">
                                    <label for="reseller-name">
                                        Name
                                    </label>

                                    <input type="text" name="reseller_name" class="form-control" id="reseller-name" value="{{ old('reseller_name', $reseller->name) }}" readonly>

                                    {!! $errors->first('reseller_name', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('reseller_email') ? 'has-error': '' }}">
                                    <label for="reseller-email">
                                        Email
                                    </label>

                                    <input type="text" name="reseller_email" class="form-control" id="reseller-email" value="{{ old('reseller_email', $reseller->email) }}" readonly>

                                    {!! $errors->first('reseller_email', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('reseller_phone') ? 'has-error': '' }}">
                                    <label for="reseller-phone">
                                        Phone
                                    </label>

                                    <input type="text" name="reseller_phone" class="form-control" id="reseller-phone" value="{{ old('reseller_phone', $reseller->phone) }}" readonly>

                                    {!! $errors->first('reseller_phone', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row box-wrapper address clearfix">
                            <div class="col-sm-12 box-header">
                                <h5><span>Customer Info</span></h5>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('customer_name') ? 'has-error': '' }}">
                                    <label for="customer-name">
                                        Name
                                    </label>

                                    <input type="text" name="customer_name" class="form-control" id="customer-name" value="{{ old('customer_name', $order->data['customer_name']) }}" readonly>

                                    {!! $errors->first('customer_name', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('customer_email') ? 'has-error': '' }}">
                                    <label for="customer-email">
                                        Email
                                    </label>

                                    <input type="text" name="customer_email" class="form-control" id="customer-email" value="{{ old('customer_email', $order->data['customer_email']) }}" readonly>

                                    {!! $errors->first('customer_email', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('customer_phone') ? 'has-error': '' }}">
                                    <label for="customer-phone">
                                        Phone
                                    </label>

                                    <input type="text" name="customer_phone" class="form-control" id="customer-phone" value="{{ old('customer_phone', $order->data['customer_phone']) }}" readonly>

                                    {!! $errors->first('customer_phone', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('customer_address') ? 'has-error': '' }}">
                                    <label for="customer-address">
                                        Address
                                    </label>

                                    <input type="text" name="customer_address" class="form-control" id="customer-address" value="{{ old('customer_address', $order->data['customer_address']) }}" readonly>

                                    {!! $errors->first('customer_address', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row box-wrapper address clearfix">
                            <div class="col-sm-12 box-header">
                                <br>
                                <h5><span>Order Info</span></h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('shop') ? 'has-error': '' }}">
                                    <label for="reseller-shop">
                                        Shop
                                    </label>

                                    <input type="text" name="shop" class="form-control" id="reseller-shop" value="{{ $order->shop->name }}" readonly>

                                    {!! $errors->first('shop', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('delivery_method') ? 'has-error': '' }}">
                                    <label for="delivery-method">
                                        Delivery Method
                                    </label>

                                    <input type="text" name="delivery_method" class="form-control" id="delivery-method" value="{{ old('delivery_method', $order->data['delivery_method']) }}" readonly>

                                    {!! $errors->first('delivery_method', '<span class="error-message">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row box-wrapper address clearfix">
                            <div class="col-sm-12 box-header">
                                <br>
                                <h5><span>Ordered Products</span></h5>
                            </div>
                            <div class="order-products table-responsive">
                                <table class="table table-bordered table-stripped table-hover table-narrow">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Price[<small class="uppercase">WHOLESALE</small>]</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->data['products'] as $item)
                                        @php
                                            $quantity = 0;
                                            $pw = $products->find($item['id'])->wholesale;
                                            $iw = $item['wholesale']
                                        @endphp
                                        <tr>
                                            <td><a class="text-uppercase" href="{{ route('reseller.product.show', $item['slug']) }}">{{ $item['code'] }}</a></td>
                                            <td>
                                                <strong>Buy: </strong>{{ $iw }}
                                                @if($iw != $pw)
                                                <br>
                                                <strong>Current: </strong>{{ $pw }}
                                                @endif
                                            </td>
                                            <td>
                                                @php $quantity += $item['quantity'] @endphp
                                                {{ $item['quantity'] }}
                                            </td>
                                            <td>
                                                <strong>Buy: </strong>{{ $iw * $item['quantity'] }}
                                                @if($iw != $pw)
                                                <br>
                                                <strong>Current: </strong>{{ $pw * $item['quantity'] }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3"><strong class="float-right">Total[<small class="uppercase">WHOLESALE</small>]</strong></td>
                                            <td>
                                                <strong>Buy: </strong>{{ $order->data['price'] }}
                                                @if($order->data['price'] != $cp)
                                                <br>
                                                <strong>Current:</strong> {{ $cp }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header"><strong>Calculations</strong>
                @if($order->status == 'completed' | $order->status == 'returned')
                <div class="card-header-actions">
                    <a href="{{ url()->current() }}/invoice" class="btn btn-sm btn-outline-secondary card-header-action">Invoice</a>
                </div>
                @endif
            </div>
            <div class="card-body">
                @livewire('charge-calculator', [
                    'order' => $order,
                    'quantity' => $quantity,
                    'cp' => $cp
                ])
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@livewireScripts
@endsection