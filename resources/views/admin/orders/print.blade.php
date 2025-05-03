@extends('layouts.ready')
@section('styles')
<style>
    .address {
        margin-top: .25rem;
        margin-bottom: .25rem;
        white-space: break-spaces;
    }
    #invoice-reseller {
        display: none;
    }
    #ui-view div {
        font-size: 16px;
    }
    @media print {
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0mm !important;  /* this affects the margin in the printer settings */
        }
        .app-header {
            display: none !important;
        }
        .app-body {
            margin-top: 0 !important;
        }
        #invoice-wrapper {
            margin-top: 0 !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
        #invoice-reseller {
            display: flex;
        }
        #ui-view > .card {
            box-shadow: none !important;
            /* border: 0 !important; */
            /* page-break-before: none; */
        }
        tr.head-row {
            background-color: red !important;
            -webkit-print-color-adjust: exact;
        }
        .aside-menu {
            display: none;
        }
        .table-sm td, .table-sm th {
            padding: 0.2rem;
        }
    }
    .subtotal {
        border-top: 2px solid #555;
        border-bottom: 2px solid #555;
    }
    .payable {
        border-top: 2px solid #ccc;
    }
    .qr-code > * {
        height: 160px;
        width: 160px;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div id="invoice-wrapper" class="col-md-8">
        <div id="ui-view">
            @foreach ($orders as $order)
                <div style="page-break-after: always;">
                @php $shop = $order->shop @endphp
                @include('order.invoice.admin')
                @include('order.invoice.reseller')
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.btn-print').click(function (e) {
            e.preventDefault();
            javascript:window.print();
        });

        window.onload = function () {
            setTimeout(function() {
                window.print();
            }, 1000);
        };
        // window.onfocus = function() {
        //     window.close();
        // };
        window.onafterprint = function() {
            if (confirm('Book to Courier?')) {
                $.ajax({
                    url: '/admin/order/booking',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        order_ids: '{{request('ids')}}'.split(',')
                    }),
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (response) {
                        window.location.href = '{{ route('admin.order.index', ['status' => 'shipping']) }}';
                    },
                    complete: function () {

                    }
                });
            } else {
                window.close();
            }
        };
    });
</script>
@endsection