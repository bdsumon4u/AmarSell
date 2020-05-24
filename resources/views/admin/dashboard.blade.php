@extends('layouts.ready')

@section('styles')
<style>
    table th,
    table td {
        /* vertical-align: middle !important; */
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="orders-table">
            <div class="card rounded-0 shadow-sm">
                <div class="card-header"><strong>Pending Orders</strong></div>
                <div class="card-body">
                    <div class="table-responive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reseller</th>
                                    <th>At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr data-row-id="{{ $order->id }}">
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.resellers.show', $order->reseller->id) }}">
                                            <strong>Name:</strong> {{ $order->reseller->name }}
                                            <br>
                                            <strong>Phone:</strong> {{ $order->reseller->phone }}
                                        </a>
                                    </td>
                                    <td>{{ $order->created_at->format('d-M-Y') }}</td>
                                    <td><a class="btn btn-sm btn-block btn-primary" href="{{ route('admin.order.show', $order->id) }}">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="transactions-table">
            <div class="card rounded-0 shadow-sm">
                <div class="card-header"><strong>Pending Transactions</strong></div>
                <div class="card-body">
                    <div class="table-responive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reseller</th>
                                    <th>Amount</th>
                                    <th>At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr data-row-id="{{ $transaction->id }}">
                                    <td>{{ $transaction->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.resellers.show', $transaction->reseller->id) }}">
                                            <strong>Name:</strong> {{ $transaction->reseller->name }}
                                            <br>
                                            <strong>Phone:</strong> {{ $transaction->reseller->phone }}
                                        </a>
                                    </td>
                                    <td>{{ theMoney($transaction->amount) }}</td>
                                    <td>{{ $transaction->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-block btn-primary" href="{{ route('admin.transactions.pay-to-reseller', [$transaction->reseller->id,
                                            'transaction_id' => $transaction->id,
                                            'amount' => $transaction->amount,
                                            'method' => $transaction->method,
                                            'bank_name' => $transaction->bank_name,
                                            'account_name' => $transaction->account_name,
                                            'branch' => $transaction->branch,
                                            'routing_no' => $transaction->routing_no,
                                            'account_type' => $transaction->account_type,
                                            'account_number' => $transaction->account_number,
                                        ]) }}">Pay</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn btn-sm' });
    
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            paginate: {
                previous: '<i class="fa fa-angle-left"></i>',
                first: '<i class="fa fa-angle-double-left"></i>',
                last: '<i class="fa fa-angle-double-right"></i>',
                next: '<i class="fa fa-angle-right"></i>',
            },
        },
        columnDefs: [
            {
                orderable: false,
                searchable: false,
                targets: -1
            },
        ],
        select: {
            style:    'multi+shift',
            selector: 'td:first-child'
        },
        order: [],
        scrollX: true,
        pagingType: 'numbers',
        pageLength: 25,
        dom: 'ft<"actions">',
    });
    $('.datatable').DataTable({
    });
</script>
@endsection