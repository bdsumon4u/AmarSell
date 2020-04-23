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
                <div class="card-header"><strong>Transaction</strong></div>
                <div class="card-body">
                    <div class="table-responive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Remain</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr data-row-id="{{ $transaction->id }}">
                                    <td></td>
                                    <td>{{ $transaction->id }}</td>
                                    @php $reseller = $transaction->reseller @endphp
                                    <td>
                                        <a href="">{{ $reseller->name }}</a>
                                    </td>
                                    <td>
                                        <a href="">{{ $reseller->phone }}</a>
                                    </td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->created_at->format('F j, Y') }}</td>
                                    <td>{{ $reseller->balance }}</td>
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