@extends('reseller.products.layout')

@section('content')
<div class="content-wrapper clearfix ">
    <div class="container">
        <div class="page-wrapper clearfix">
            <h3 class="page-title">{{ $page->title }}</h3>
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection