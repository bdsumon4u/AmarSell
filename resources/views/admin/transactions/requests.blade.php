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
    <div class="col-sm-12">
        <div class="orders-table">
            <div class="card rounded-0 shadow-sm">
                <div class="card-header"><strong>Transaction</strong> Requests</div>
                <div class="card-body">
                    <div class="table-responive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Reseller</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Way</th>
                                    <th>Account Number</th>
                                    <th>Transaction Number</th>
                                    <th>Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr data-row-id="{{ $transaction->id }}">
                                    <td></td>
                                    <td>{{ $transaction->id }}</td>
                                    @php $reseller = $transaction->reseller @endphp
                                    <td>
                                        <a href="{{ route('reseller.profile.show', $reseller->id) }}">
                                            <strong>Name:</strong> {{ $reseller->name }}
                                            <br>
                                            <strong>Phone:</strong> {{ $reseller->phone }}
                                        </a>
                                    </td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->created_at->format('F j, Y') }}</td>
                                    <td>
                                        <strong>Method:</strong> {{ $transaction->method }}
                                        @if($transaction->method == 'Bank')
                                        <br>
                                        <strong>Bank Name:</strong> {{ $transaction->bank_name }}
                                        <br>
                                        <strong>Account Name:</strong> {{ $transaction->account_name }}
                                        <br>
                                        <strong>Branch:</strong> {{ $transaction->branch }}
                                        <br>
                                        <strong>Routing No:</strong> {{ $transaction->routing_no }}
                                        @endif
                                    </td>
                                    <td>{{ $transaction->account_number }}</td>
                                    <td>{{ $transaction->transaction_number }}</td>
                                    <td><a class="btn btn-sm btn-block btn-primary" href="{{ route('admin.transactions.pay-to-reseller', [$reseller->id,
                                        'amount' => $transaction->amount,
                                        'method' => 'Bank',
                                        'bank_name' => $transaction->bank_name,
                                        'account_name' => $transaction->account_name,
                                        'branch' => $transaction->branch,
                                        'routing_no' => $transaction->routing_no,
                                        'account_type' => $transaction->account_type,
                                        'account_number' => $transaction->account_number,
                                    ]) }}">Pay</a></td>
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
                className: 'select-checkbox',
                searchable: false,
                targets: 0,
            },
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
        dom: 'lBfrtip<"actions">',
        buttons: [
            {
                extend: 'selectAll',
                className: 'btn-primary',
                text: 'Select All',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'selectNone',
                className: 'btn-primary',
                text: 'Deselect All',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'copy',
                className: 'btn-light',
                text: 'Copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-light',
                text: 'CSV',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-light',
                text: 'Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-light',
                text: 'Print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                className: 'btn-light',
                text: 'Columns',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
    });
    var dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
    $('.datatable').DataTable({
        buttons: dtButtons
    });
</script>
@endsection