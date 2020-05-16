@extends('layouts.ready')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header py-2">Add New <strong>FAQ</strong></div>
            <div class="card-body p-2">
                <form action="{{ route('admin.faqs.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" name="question" value="{{ old('question') }}" id="question" class="form-control">
                                {!! $errors->first('question', '<span class="invalid-feedback">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="answer">Answer</label><span class="text-danger">*</span>
                                <textarea editor name="answer" id="" cols="30" rows="10" class="form-control @error('answer') is-invalid @enderror">{{ old('answer') }}</textarea>
                                {!! $errors->first('answer', '<span class="invalid-feedback">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection