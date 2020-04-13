@extends('layouts.ready')

@section('styles')
@livewireStyles
<style>
    .nav-tabs .nav-item .nav-link {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .formatted-categories ul {
        list-style: none;
        padding: 0;
    }
    .formatted-categories ul li {
        background-color: #f3f3f3;
        padding: 5px 10px;
        margin-bottom: 2px;
    }
    .formatted-categories ul li:hover {
        background-color: aliceblue;
    }
    .formatted-categories ul li:hover a {
        text-decoration: none;
    }
    .formatted-categories ul li:hover,
    .formatted-categories ul li.active,
    .formatted-categories ul li.active a {
        color: deeppink;
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header"><strong>All</strong> <small><i>Categories</i></small></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="formatted-categories">
                            @if($categories->isEmpty())
                            <div class="alert alert-danger py-2"><strong>No Categories Found.</strong></div>
                            @else
                            <x-categories.tree :categories="$categories" />
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="nav-tabs-boxed">
                            <div class="card rounded-0 shadow-sm">
                                <div class="card-header">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#create-category"
                                                role="tab" aria-controls="create-category" aria-selected="false">Create</a>
                                        </li>
                                        @if(request('active_id'))
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#edit-category"
                                                role="tab" aria-controls="edit-category" aria-selected="false">Edit</a>
                                        </li>
                                        <li class="nav-item ml-auto">
                                            <form action="{{ route('admin.categories.destroy', request('active_id', 0)) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="nav-link text-danger delete-action">Delete</button>
                                            </form>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="card-body">
                                    @if($message = Session::get('success'))
                                    <div class="alert alert-info py-2"><strong>{{ $message }}</strong></div>
                                    @endif
                                    @php $active = App\Category::find(request('active_id')) @endphp
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="create-category" role="tabpanel">
                                            <p class="text-info">Create <strong>{{ $active ? 'Child' : 'Root' }}</strong> Category</p>
                                            <form action="{{ route('admin.categories.store') }}" method="post">
                                                @csrf
                                                @livewire('slugify', [
                                                    'src' => [
                                                        'label' => 'Name',
                                                        'name' => 'name',
                                                        'id' => 'create-name'
                                                    ],
                                                    'emt' => [
                                                        'label' => 'SLUG',
                                                        'name' => 'slug',
                                                        'id' => 'create-slug'
                                                    ]
                                                ])
                                                <div class="form-group">
                                                    <label for="create-parent-id">Select Parent</label>
                                                    <x-category-dropdown :categories="$categories" name="parent_id" placeholder="Select parent" id="create-parent-id" :selected="request('active_id', 0)" />
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success d-block ml-auto"><i class="fa fa-check"></i> Submit</button>
                                            </form>
                                        </div>
                                        @if(request('active_id'))
                                        <div class="tab-pane" id="edit-category" role="tabpanel">
                                            <p class="text-info">Edit Category</p>
                                            <form action="{{ route('admin.categories.update', request('active_id', 0)) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                @livewire('slugify', [
                                                    'src' => [
                                                        'label' => 'Name',
                                                        'name' => 'name',
                                                        'id' => 'edit-name',
                                                        'default' => old('name', $active->name ?? '')
                                                    ],
                                                    'emt' => [
                                                        'label' => 'SLUG',
                                                        'name' => 'slug',
                                                        'id' => 'edit-slug',
                                                        'default' => old('slug', $active->slug ?? '')
                                                    ]
                                                ])
                                                <div class="form-group">
                                                    <label for="edit-parent-id">Select Parent</label>
                                                    <x-category-dropdown :categories="$categories" name="parent_id" placeholder="Select parent" id="edit-parent-id" :selected="$active->parent->id ?? 0" :disabled="$active->id" />
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success d-block ml-auto"><i class="fa fa-check"></i> Submit</button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@livewireScripts
@endsection