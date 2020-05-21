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
                <div class="card-header"><strong>Resellers</strong></div>
                <div class="card-body">
                    <div class="table-responive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Reseller</th>
                                    <th>Last Paid</th>
                                    <th>Total Sell</th>
                                    <th>Pending Sell</th>
                                    <th>Completed Sell</th>
                                    <th>Total Withdraw</th>
                                    <th>Balance</th>
                                    <th>Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resellers as $reseller)
                                <tr data-row-id="{{ $reseller->id }}">
                                    <td></td>
                                    <td>{{ $reseller->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.reseller', $reseller->id) }}">
                                            <strong>Name:</strong> {{ $reseller->name }}
                                            <br>
                                            <strong>Phone:</strong> {{ $reseller->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($reseller->lastPaid->created_at)
                                            {{ theMoney($reseller->lastPaid->amount) }}
                                            <br>
                                            {{ $reseller->lastPaid->created_at->format('F j, Y') }}
                                        @endif
                                    </td>
                                    <td>{{ theMoney($reseller->total_sell) }}</td>
                                    <td>{{ theMoney($reseller->pending_sell) }}</td>
                                    <td>{{ theMoney($reseller->completed_sell) }}</td>
                                    <td>{{ theMoney($reseller->total_withdraw) }}</td>
                                    <td>{{ theMoney($reseller->balance) }}</td>
                                    <td><a class="btn btn-sm btn-block btn-primary" href="{{ route('admin.transactions.pay-to-reseller', $reseller->id) }}">Pay</a></td>
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