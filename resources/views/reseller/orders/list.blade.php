@extends('reseller.layout')

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
                <div class="card-header"><strong>All Orders</strong></div>
                <div class="card-body">
                    <div class="table-responive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Ordered At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr data-row-id="{{ $order->id }}">
                                    <td></td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <strong>Name:</strong> {{ $order->data['customer_name'] }}
                                        <br>
                                        <strong>Phone:</strong> {{ $order->data['customer_phone'] }}
                                    </td>
                                    <td><span class="badge badge-square badge-primary text-uppercase">{{ $order->status }}</span></td>
                                    <td>
                                        <strong>Buy:</strong> {{ $order->data['price'] }}
                                        <br>
                                        @if($order->status == 'pending')
                                            @php $current_price = $order->current_price() @endphp
                                            @if($order->data['price'] != $current_price)
                                                <strong>Current:</strong> {{ $current_price }}
                                                <br>
                                            @endif
                                        @endif
                                        <strong>Sell:</strong> {{ $order->data['sell'] }}
                                    </td>
                                    <td>{{ $order->created_at->format('d-M-Y') }}</td>
                                    <td><a class="btn btn-sm btn-block btn-primary" target="_blank" href="{{ route('reseller.order.show', $order->id) }}">View</a></td>
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
            // {
            //     extend: 'copy',
            //     className: 'btn-light',
            //     text: 'Copy',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            // },
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