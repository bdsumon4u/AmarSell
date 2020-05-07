@extends('layouts.ready')

@section('styles')
@livewireStyles
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header py-2">Add New <strong>Page</strong></div>
            <div class="card-body p-2">
                <form action="{{ route('admin.pages.store') }}" method="post">
                    @csrf
                    @livewire('slugify', [
                        'src' => [
                            'label' => 'Page Title',
                            'name' => 'title',
                            'id' => 'title'
                        ],
                        'emt' => [
                            'label' => 'SLUG',
                            'name' => 'slug',
                            'id' => 'slug',
                        ]
                    ])
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content">Content</label><span class="text-danger">*</span>
                                <textarea editor name="content" id="" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                                {!! $errors->first('content', '<span class="invalid-feedback">:message</span>') !!}
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

@section('scripts')
@livewireScripts
@endsection