@component('mail::message')
# Dear Valuable reseller,

@if($type == 'request')
Your <strong>Money Request #{{ $data['id'] }}</strong> For <strong>Amount {{ theMoney($data['amount']) }}</strong><br>
Has Paid.<br>
@else
You're Paid <strong>Amount {{ theMoney($data['amount']) }}</strong><br>
@endif
Via <strong>{{ $data['method'] }}{{ isset($data['bank_name']) ? ' [ '. $data['bank_name'] . ' ] ' : '' }}{{ isset($data['account_name']) ? ' [ '. $data['account_name'] . ' ] ' : '' }} [ {{ $data['account_type'] }} ] [ {{ $data['account_number'] }} ]</strong><br>
Stay With Us.<br>

Thank you for using our application!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
