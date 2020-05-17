@extends('layouts.ready')

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
                    <form class="d-inline-block" action="{{ route('admin.notifications.update') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">Mark All As Read</button>
                    </form>
                    <form class="d-inline-block" action="{{ route('admin.notifications.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="delete" value="unread">
                        <button type="submit" class="btn btn-sm btn-danger">Delete Unread</button>
                    </form>
                    <form class="d-inline-block" action="{{ route('admin.notifications.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="delete" value="read">
                        <button type="submit" class="btn btn-sm btn-danger">Delete Read</button>
                    </form>
                    <form class="d-inline-block" action="{{ route('admin.notifications.destroy') }}" method="post">
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
                                    @case('money-request-recieved')
                                        A New <strong>Money Request #{{ $data['transaction_id'] }}</strong> For <strong>Amount {{ theMoney($data['amount']) }}</strong><br>
                                        @php $reseller = \App\Reseller::findOrFail($data['reseller_id']) @endphp
                                        From Reseller <a href="{{ route('reseller.profile.show', $reseller->id) }}">{{ $reseller->name }}</a> [ Balance: <strong>{{ theMoney($reseller->balance) }}</strong> ]<br>
                                        Via <strong>{{ $data['method'] }}{{ $data['bank_name'] ? ' [ '. $data['bank_name'] . ' ] ' : '' }}{{ $data['account_name'] ? ' [ '. $data['account_name'] . ' ] ' : '' }} [ {{ $data['account_type'] }} ] [ {{ $data['account_number'] }} ]</strong><br>
                                        Has Recieved.<br>
                                        @php $transaction = \App\Transaction::findOrFail($data['transaction_id']) @endphp
                                        @if($transaction->status == 'pending')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.transactions.pay-to-reseller', [$data['reseller_id'],
                                            'transaction_id' => $transaction->id,
                                            'amount' => $data['amount'],
                                            'method' => $data['method'],
                                            'bank_name' => $data['bank_name'],
                                            'account_name' => $data['account_name'],
                                            'branch' => $data['branch'],
                                            'routing_no' => $data['routing_no'],
                                            'account_type' => $data['account_type'],
                                            'account_number' => $data['account_number'],
                                        ]) }}">Pay Now</a>
                                        @else
                                        <span class="badge badge-secondary text-light p-2">Paid</span>
                                        @endif
                                    @break

                                    @case('new-order-recieved')
                                        @if($order = \App\Order::find($data['order_id']))
                                            A New Order From Reseller <a href="{{ route('reseller.profile.show', $data['reseller_id']) }}">{{ $data['reseller_name'] }}</a> [ Phone: <strong>{{ $data['reseller_phone'] }}</strong> ] [ Balance: <strong>{{ theMoney($data['reseller_balance']) }}</strong> ]<br>
                                            For Products:
                                            <ul class="my-2">
                                                @foreach($order->data['products'] as $product)
                                                <li><a href="{{ route('admin.products.show', $product['id']) }}">{{ $product['name'] }}</a> [Qty: {{ $product['quantity'] }}]</li>
                                                @endforeach
                                            </ul>
                                            Has Recieved.<br>
                                            @if($order->status == 'pending')
                                            <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                            @else
                                            <span class="badge badge-secondary text-light p-2">Accepted</span>
                                            @endif
                                        @else
                                            <span class="text-danger">A New Order Has Cancelled.</span>
                                        @endif
                                    @break
                                @endswitch
                            </div>
                            <div class="card-footer p-2">
                                <div class="d-flex justify-content-between">
                                    <!-- <div class="col-md-6"> -->
                                        @if($unread)
                                        <form action="{{ route('admin.notifications.update', $notification->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Mark As Read</button>
                                        </form>
                                        @endif
                                    <!-- </div> -->
                                    <!-- <div class="col-md-6"> -->
                                        <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="post">
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