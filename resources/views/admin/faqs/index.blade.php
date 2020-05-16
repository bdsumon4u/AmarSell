@extends('layouts.ready')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header py-2">All <strong>FAQs</strong></div>
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10">ID</th>
                                        <th>Question</th>
                                        <th width="10">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>
                                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection