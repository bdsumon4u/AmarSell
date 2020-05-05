@extends('layouts.ready')

@section('styles')
@livewireStyles
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @livewire('payment-calculator', [
            'reseller' => $reseller,
            'amount' => request('amount'),
            'method' => request('method')
        ])
    </div>
</div>
@endsection

@section('scripts')
@livewireScripts
@endsection