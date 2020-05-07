@extends('reseller.products.layout')

@section('content')
<div class="content-wrapper clearfix ">
    <div class="container">
        <div class="page-wrapper clearfix">
            <h3>{{ $page->title }}</h3>
            <div class="page-content">
            {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@endsection