<div class="p-2">
    @php $reseller = auth('reseller')->user() @endphp
    <table class="table table-sm table-borderless">
        <tr>
            <th>Total Sell:</th>
            <td>{{ theMoney($reseller->total_sell) }}</td>
        </tr>
        <tr>
            <th>Pending Sell:</th>
            <td>{{ theMoney($reseller->pending_sell) }}</td>
        </tr>
        <tr>
            <th>Processing Sell:</th>
            <td>{{ theMoney($reseller->processing_sell) }}</td>
        </tr>
        <tr>
            <th>Shipping Sell:</th>
            <td>{{ theMoney($reseller->shipping_sell) }}</td>
        </tr>
        <tr>
            <th>Completed Sell:</th>
            <td>{{ theMoney($reseller->completed_sell) }}</td>
        </tr>
        <tr>
            <th>Returned Sell:</th>
            <td>{{ theMoney($reseller->returned_sell) }}</td>
        </tr>
        <tr>
            <th>Total Paid:</th>
            <td>{{ theMoney($reseller->paid) }}</td>
        </tr>
    </table>
</div>