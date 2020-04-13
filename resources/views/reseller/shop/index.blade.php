@extends('layouts.ready')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header"><strong>My Shops</strong></div>
            <div class="card-body">
                <div class="row justify-content-around">
                    @foreach($shops as $shop)
                    <div class="col-md-6">
                        <div class="card rounded-0 shadow-sm">
                            <div class="card-header">{{ $shop->name }}</div>
                            <div class="card-body">
                                <div>{!! $shop->description !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection