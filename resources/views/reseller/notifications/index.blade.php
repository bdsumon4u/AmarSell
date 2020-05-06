@extends('reseller.layout')

@section('styles')
<style>
    .border-top-red {
        border-top: 2px solid red;
    }
    .border-top-green {
        border-top: 2px solid green;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header"><strong>Notifications</strong>
                @if($notifications->count())
                <div class="card-header-actions">
                    <form class="d-inline-block" action="{{ route('reseller.notifications.update') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">Mark All As Read</button>
                    </form>
                    <form class="d-inline-block" action="{{ route('reseller.notifications.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="delete" value="unread">
                        <button type="submit" class="btn btn-sm btn-danger">Delete Unread</button>
                    </form>
                    <form class="d-inline-block" action="{{ route('reseller.notifications.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="delete" value="read">
                        <button type="submit" class="btn btn-sm btn-danger">Delete Read</button>
                    </form>
                    <form class="d-inline-block" action="{{ route('reseller.notifications.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete All</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="card-body">
                @if($notifications->isEmpty())
                    <div class="alert alert-danger mb-0"><strong>Notification Box Is Empty!</strong></div>
                @endif
                @foreach($notifications as $day => $notification_s)
                    <h6 class="text-center {{ $loop->first ? '' : 'mt-5' }} mb-3">{{ $day }}</h6>
                    @foreach($notification_s as $notification)
                        @php $unread = $notification->unread() @endphp
                        <div class="card">
                            <div class="card-header p-2 {{ $unread ? 'border-top-red' : 'border-top-green' }}">
                                @if($unread)
                                <span class="bg-secondary p-1 text-light">Unread</span>
                                @else
                                <span class="bg-secondary p-1 text-light">Read At</span> {{ $notification->updated_at->format('F j, Y - h:i A') }}
                                @endif
                                <span class="float-right">{{ $notification->created_at->format('h:i A') }}</span></div>
                            <div class="card-body p-2">
                                @php $data = $notification->data @endphp
                                @switch($data['notification'])
                                    @case('order-status-changed')
                                        Dear Valuable Reseller,<br>
                                        Your <a target="_blank" href="{{ route('reseller.order.show', $data['order_id']) }}">Order #{{ $data['order_id'] }}</a> Status Has Changed From "{{ ucwords($data['before']) }}" To "{{ ucwords($data['after']) }}".<br>
                                        Stay With Us.<br>
                                        Thank You.
                                    @break

                                    @case('money-request-recieved')
                                        Dear Valuable Reseller,<br>
                                        Your <strong>Money Request #{{ $data['transaction_id'] }}</strong> For <strong>Amount {{ theMoney($data['amount']) }}</strong><br>
                                        Via <strong>{{ $data['method'] }}{{ $data['bank_name'] ? ' [ '. $data['bank_name'] . ' ] ' : '' }}{{ $data['account_name'] ? ' [ '. $data['account_name'] . ' ] ' : '' }} [ {{ $data['account_type'] }} ] [ {{ $data['account_number'] }} ]</strong><br>
                                        Has Recieved.<br>
                                        Stay With Us.<br>
                                        Thank You.
                                    @break

                                    @case('transaction-completed')
                                        Dear Valuable Reseller,<br>
                                        @if($data['type'] == 'request')
                                        Your <strong>Money Request #{{ $data['transaction_id'] }}</strong> For <strong>Amount {{ theMoney($data['amount']) }}</strong><br>
                                        Has Paid.<br>
                                        @else
                                        You're Paid <strong>Amount {{ theMoney($data['amount']) }}</strong><br>
                                        @endif
                                        Via <strong>{{ $data['method'] }}{{ $data['bank_name'] ? ' [ '. $data['bank_name'] . ' ] ' : '' }}{{ $data['account_name'] ? ' [ '. $data['account_name'] . ' ] ' : '' }} [ {{ $data['account_type'] }} ] [ {{ $data['account_number'] }} ]</strong><br>
                                        Stay With Us.<br>
                                        Thank You.
                                    @break
                                @endswitch
                            </div>
                            <div class="card-footer p-2">
                                <div class="d-flex justify-content-between">
                                    <!-- <div class="col-md-6"> -->
                                        @if($unread)
                                        <form action="{{ route('reseller.notifications.update', $notification->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Mark As Read</button>
                                        </form>
                                        @endif
                                    <!-- </div> -->
                                    <!-- <div class="col-md-6"> -->
                                        <form action="{{ route('reseller.notifications.destroy', $notification->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection