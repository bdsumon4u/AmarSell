@extends('layouts.ready')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="{{ isset($department) ? route('categories.update', $department->slug) : route('categories.store') }}" method="post">
            @csrf
            @if(isset($department))
                @method('PATCH')
            @endif
            <div class="card rounded-0 shadow-sm">
                <div class="card-header">@if(isset($department))<strong>Edit</strong>@else<strong>Add New</strong>@endif <small>Department</small>
                    <div class="card-header-actions">
                        <button type="submit" class="card-header-action btn btn-sm btn-light btn-square">
                            <strong><i class="fa fa-check"></i> {{ __('Submit') }}</strong>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Department Name" v-model="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="slug">SLUG</label>
                                <slugify class="form-control @error('slug') is-invalid @enderror" base="{{ url('/') }}" :seperators="['categories']" :src="name" default="{{ old('slug', isset($department->slug) ? $department->slug : '') }}" @slug="HotashSlug"></slugify>
                                
                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="slug" v-model="slug">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="standards">Standards</label>
                                <select selector name="standards[]" id="standards" class="form-control w-100" placeholder="Select Standards" multiple>
                                    @foreach($categories as $category)
                                    <option value="">{{ $category->name }}</option>
                                    @include('categories.childrens', ['childrens' => $category->childrens, 'depth' => 1])
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header"><strong>All</strong> <small>Categories</small></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Department Name" v-model="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group mb-2">
                            <label for="slug">SLUG</label>
                            <slugify class="form-control @error('slug') is-invalid @enderror" base="{{ url('/') }}" :seperators="['categories']" :src="name" default="{{ old('slug', isset($department->slug) ? $department->slug : '') }}" @slug="HotashSlug"></slugify>
                            
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="slug" v-model="slug">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group mb-2">
                            <label for="standards">Standards</label>
                            <select selector name="standards[]" id="standards" class="form-control w-100" placeholder="Select Standards" multiple>
                                @foreach($categories as $category)
                                <option value="">{{ $category->name }}</option>
                                @include('categories.childrens', ['childrens' => $category->childrens, 'depth' => 1])
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    new Vue({
        data: function(){
            return {
                name: "{{ old('name', isset($department) ? $department->name : '') }}",
                slug: "{{ old('slug', isset($department->slug) ? $department->slug : '') }}",
            }
        },
        methods: {
            HotashSlug(slug){
                this.slug = slug
            }
        }
    }).$mount('#app');
</script>
@endsection