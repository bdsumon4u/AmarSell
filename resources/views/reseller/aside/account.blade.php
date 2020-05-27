<div class="p-3">
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
            <th>Completed Sell:</th>
            <td>{{ theMoney($reseller->completed_sell) }}</td>
        </tr>
        <tr>
            <th>Total Paid:</th>
            <td>{{ theMoney($reseller->paid) }}</td>
        </tr>
        <tr>
            <th>My Balance:</th>
            <td>{{ theMoney($reseller->balance) }}</td>
        </tr>
    </table>
</div>