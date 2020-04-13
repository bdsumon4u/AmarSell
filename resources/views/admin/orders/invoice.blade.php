@extends('layouts.ready')

@section('styles')
<style>
    .address {
        margin-top: .25rem;
        margin-bottom: .25rem;
        white-space: break-spaces;
    }
</style>

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 my-5">
        <div id="ui-view">
            <div>
                <div class="card rounded-0 shadow-sm">
                    <div class="card-header d-flex align-items-center">Invoice&nbsp;<strong>#{{ $order->id }}</strong>
                        <a class="btn btn-sm btn-secondary ml-auto mr-1 d-print-none" href=""
                            onclick="javascript:window.print();">Print</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <h6 class="mb-3">From:</h6>
                                <div><strong>{{ $order->data['shop'] }}</strong></div>
                                <div>724 John Ave.</div>
                                <div>Cupertino, CA 95014</div>
                                <div>Email: email@your-great-company.com</div>
                                <div>Phone: +1 123-456-7890</div>
                            </div>

                            <div class="col-sm-4">
                                <h6 class="mb-3">To:</h6>
                                <div><strong>{{ $order->data['customer_name'] }}</strong></div>
                                <div class="address">{{ $order->data['customer_address'] }}</div>
                                <div>Email: {{ $order->data['customer_email'] }}</div>
                                <div>Phone: {{ $order->data['customer_phone'] }}</div>
                            </div>

                            <div class="col-sm-4">
                                <h6 class="mb-3">Details:</h6>
                                <div>Invoice&nbsp;<strong>#{{ $order->id }}</strong></div>
                                <div>{{ date('F d, Y') }}</div>
                                <div>Delivery Method: <strong>{{ $order->data['delevary_method'] }}</strong></div>
                                <div>Payment Status: <strong>{{ $order->data['payable'] == 0 ? 'Complete' : 'Incomplete' }}</strong></div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th class="center">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->data['products'] as $product)
                                    <tr>
                                        <td class="center">{{ $loop->index + 1 }}</td>
                                        <td class="left">{{ $product['slug'] }}</td>
                                        <td class="center">{{ $product['code'] }}</td>
                                        <td class="right">{{ $product['quantity'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-sm-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis
                                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Subtotal</strong></td>
                                            <td class="right">{{ $order->data['sell'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Shipping</strong></td>
                                            <td class="right">{{ $order->data['shipping'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>{{ $order->data['sell'] + $order->data['shipping'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Advanced</strong></td>
                                            <td class="right">{{ $order->data['advanced'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Payable</strong></td>
                                            <td class="right"><strong>{{ $order->data['payable'] }}</strong></td>
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
</div>
@endsection