@extends('layouts.ready')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="orders-table">
                <div class="card rounded-0 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <strong>All Orders</strong>
                            <div class="btn-group ml-3">
                                <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-outline-primary">All</a>
                                <a href="{{ route('admin.order.index', ['status' => 'pending']) }}"
                                    class="btn btn-sm btn-secondary">Pending</a>
                                <a href="{{ route('admin.order.index', ['status' => 'processing']) }}"
                                    class="btn btn-sm btn-warning">Processing</a>
                                <a href="{{ route('admin.order.index', ['status' => 'shipping']) }}"
                                    class="btn btn-sm btn-primary">Shipping</a>
                                <a href="{{ route('admin.order.index', ['status' => 'completed']) }}"
                                    class="btn btn-sm btn-success">Completed</a>
                                <a href="{{ route('admin.order.index', ['status' => 'returned']) }}"
                                    class="btn btn-sm btn-danger">Returned</a>
                            </div>
                        </div>
                        <div class="d-none" id="selected-actions">
                            {{-- <button id="print-selected" class="btn btn-sm btn-primary">
                                <i class="fa fa-print"></i> Print Selected
                            </button> --}}
                            <button id="book-courier" class="btn btn-sm btn-info ml-2">
                                <i class="fa fa-truck"></i> Book to Courier
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responive">
                            <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>ID</th>
                                        <th>Reseller</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Ordered At</th>
                                        <th>Completed/Returned</th>
                                        <th>Courier</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Initialize toastr options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
            className: 'btn btn-sm'
        });

        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>',
                    first: '<i class="fa fa-angle-double-left"></i>',
                    last: '<i class="fa fa-angle-double-right"></i>',
                    next: '<i class="fa fa-angle-right"></i>',
                },
            },
            columnDefs: [{
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
                {
                    orderable: false,
                    targets: [2, 3, 4, 5, 6, 7],
                },
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pagingType: 'numbers',
            pageLength: 25,
            dom: 'lfrtip<"actions">',
            // buttons: [
            //     {
            //         extend: 'selectAll',
            //         className: 'btn-primary',
            //         text: 'Select All',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            //     {
            //         extend: 'selectNone',
            //         className: 'btn-primary',
            //         text: 'Deselect All',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            //     {
            //         extend: 'csv',
            //         className: 'btn-light',
            //         text: 'CSV',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            //     {
            //         extend: 'excel',
            //         className: 'btn-light',
            //         text: 'Excel',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         className: 'btn-light',
            //         text: 'Print',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            //     {
            //         extend: 'colvis',
            //         className: 'btn-light',
            //         text: 'Columns',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            // ],
        });
        // var dt_buttons = $.extend(true, [], $.fn.dataTable.defaults.buttons);


        var table = $('.datatable').DataTable({
            search: [{
                bRegex: true,
                bSmart: false,
            }, ],
            processing: true,
            serverSide: true,
            ajax: "{!! route('api.orders.admin', request()->only(['status', 'reseller'])) !!}",
            // buttons: dt_buttons,
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'reseller',
                    name: 'reseller'
                },
                {
                    data: 'customer',
                    name: 'customer'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'ordered_at',
                    name: 'ordered_at'
                },
                {
                    data: 'completed_returned_at',
                    name: 'completed_returned_at'
                },
                {
                    data: 'courier',
                    name: 'courier'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            order: [
                [1, 'desc']
            ],
        });

        // Handle select all checkbox
        $('#select-all').on('change', function() {
            if (this.checked) {
                table.rows().select();
            } else {
                table.rows().deselect();
            }
            updatePrintButton();
        });

        // Handle individual row selection
        table.on('select deselect', function() {
            updatePrintButton();
        });

        // Update print button visibility based on selection
        function updatePrintButton() {
            var selectedRows = table.rows({
                selected: true
            }).count();
            $('#selected-actions').toggleClass('d-none', selectedRows === 0);
        }

        // Handle print button click
        $('#print-selected').on('click', function() {
            var selectedIds = table.rows({
                selected: true
            }).data().pluck('id').toArray();
            if (selectedIds.length > 0) {
                window.open('/admin/order/print?ids=' + selectedIds.join(','), '_blank');
            }
        });

        // Handle courier booking
        $('#book-courier').on('click', function() {
            var selectedIds = table.rows({
                selected: true
            }).data().pluck('id').toArray();
            if (selectedIds.length > 0) {
                // Open courier booking modal
                $('#courier-modal').modal('show');
                // Store selected order IDs for later use
                $('#courier-modal').data('order-ids', selectedIds);
            }
        });


        // $('.datatable thead tr').clone(true).appendTo( '.datatable thead' );
        // $('.datatable thead tr th').each( function (i) {
        //     if ($.inArray(i, [1]) != -1) {
        //         var title = $(this).text();
        //         $(this).removeClass('sorting').addClass('p-1').html( '<input class="form-control" type="text" placeholder="'+title+'" size="10" />' );

        //         $( 'input', this ).on( 'keyup change', function (e) {
        //             if (e.keyCode == 13 && table.column(i).search() !== this.value ) {
        //                 table
        //                     .column(i)
        //                     .search('^'+ (this.value.length ? this.value : '.*') +'$', true, false)
        //                     .draw();
        //             }
        //         } );
        //     }
        // } );
    </script>

    <!-- Courier Booking Modal -->
    <div class="modal fade" id="courier-modal" tabindex="-1" role="dialog" aria-labelledby="courier-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courier-modal-label">Book to Courier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="courier-form">
                        <div class="form-group">
                            <label for="courier-provider">Courier Provider</label>
                            <select class="form-control" id="courier-provider" name="courier_provider" required>
                                <option value="">Select Courier Provider</option>
                                <option value="Pathao">Pathao</option>
                                <option value="Stead Fast">Stead Fast</option>
                                <option value="RedX">RedX</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit-courier">Book Courier</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle courier booking submission
        $('#submit-courier').on('click', function() {
            var orderIds = $('#courier-modal').data('order-ids');
            var data = {
                order_ids: orderIds,
                courier_provider: $('#courier-provider').val()
            };

            $.ajax({
                url: '/admin/order/booking',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(data),
                contentType: 'application/json',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#courier-modal').modal('hide');
                        table.ajax.reload();
                        toastr.success(response.message || 'Orders booked to courier successfully');
                    } else {
                        toastr.error(response.message || 'Failed to book orders to courier');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 419) {
                        toastr.error('CSRF token mismatch. Please refresh the page and try again.');
                    } else {
                        toastr.error(response.message || 'An error occurred while booking orders to courier');
                    }
                }
            });
        });
    </script>
@endsection
