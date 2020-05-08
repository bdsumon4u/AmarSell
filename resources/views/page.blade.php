@extends('reseller.products.layout')

@section('content')
<div class="content-wrapper clearfix ">
    <div class="container">
        <div class="page-wrapper clearfix">
            <h2 class="section-title">{{ $page->title }}</h2>
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection