@extends('layouts.ready')

@section('styles')
@livewireStyles
<style>
    .nav-tabs {
        border: 2px solid #ddd;
    }
    .nav-tabs li:hover a,
    .nav-tabs li a.active {
        border-radius: 0;
        border-bottom-color: #ddd !important;
    }
    .nav-tabs li a.active {
        background-color: #f0f0f0 !important;
    }
    .nav-tabs li a:hover {
        border-bottom: 1px solid #ddd;
        background-color: #f7f7f7;
    }

    .is-invalid + .SumoSelect + .invalid-feedback {
        display: block;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header py-2">Add New <strong>Product</strong></div>
            <div class="card-body p-2">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <ul class="nav nav-tabs list-group" role="tablist">
                            <li class="nav-item rounded-0"><a class="nav-link @if($errors->has('name') || $errors->has('slug') || $errors->has('description')) text-danger @endif active" data-toggle="tab" href="#item-1">General</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link @if($errors->has('wholesale') || $errors->has('retail')) text-danger @endif" data-toggle="tab" href="#item-2">Price</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link" data-toggle="tab" href="#item-3">Inventory</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link @if($errors->has('base_image') || $errors->has('additional_images') || $errors->has('additional_images.*')) text-danger @enderror" data-toggle="tab" href="#item-4">Images</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-8 col-xl-9">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                                    <div class="tab-content">
                                        @csrf
                                        <div class="tab-pane active" id="item-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">General</small></h4>
                                                </div>
                                            </div>
                                            @livewire('slugify', [
                                                'src' => [
                                                    'label' => 'Product Name',
                                                    'name' => 'name',
                                                    'id' => 'name'
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
                                                        <label for="description">Description</label><span class="text-danger">*</span>
                                                        <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                                        {!! $errors->first('description', '<span class="invalid-feedback">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="categories" class="@error('categories') is-invalid @enderror">Categories</label><span class="text-danger">*</span>
                                                        <x-category-dropdown :categories="$categories" name="categories[]" placeholder="Select Category" id="categories" multiple="true" />
                                                        {!! $errors->first('categories', '<span class="invalid-feedback">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-success">Save Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="item-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Price</small></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="wholesale">Wholesale Price</label><span class="text-danger">*</span>
                                                        <input type="text" name="wholesale" value="{{ old('wholesale') }}" id="wholesale" class="form-control @error('wholesale') is-invalid @enderror">
                                                        {!! $errors->first('wholesale', '<span class="invalid-feedback">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="retail">Retail Price</label><span class="text-danger">*</span>
                                                        <input type="text" name="retail" id="retail" value="{{ old('retail') }}" class="form-control @error('retail') is-invalid @enderror">
                                                        {!! $errors->first('retail', '<span class="invalid-feedback">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-success">Save Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="item-3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Track Inventory</small></h4>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="should_track" value="1" @if(old('should_track')) checked @endif id="should-track" class="custom-control-input">
                                                            <label for="should-track" class="custom-control-label @error('stock') is-invalid @enderror">Track</label>
                                                            @error('stock')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group stock-count" @if(!old('should_track', 0)) style="display: none;" @endif>
                                                        <label for="stock">Stock Count</label>
                                                        <input type="text" name="stock" id="stock" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-success">Save Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="item-4" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Product Images</small></h4>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="base_image" class="d-block mb-2"><strong>Base Image</strong></label>
                                                                <input type="file" name="base_image" class="@error('base_image') is-invalid @enderror" id="base_image">
                                                                <img src="" alt="Base Image" id="base_image-preview" class="mt-2 img-thumbnail img-responsive" style="display: none; height: 150px; width: 150px;">
                                                                @error('base_image')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="additional_images" class="d-block mb-2"><strong>Additional Images</strong></label>
                                                                <input type="file" name="additional_images[]" class="@if($errors->has('additional_images') || $errors->has('additional_images.*')) is-invalid @endif"  id="additional_images" multiple>
                                                                @error('additional_images')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                @error('additional_images.*')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-success">Save Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
<script>
    $(document).ready(function(){
        $('[name="base_image"]').change(function(e){
            renderBaseImage(this);
        });
        $('[name="additional_images[]"]').change(function(e){
            renderAdditionalImages(this);
        });

        function renderBaseImage(input) {
            if(input.files.length) {
                var reader = new FileReader;
                reader.readAsDataURL(input.files[0]);
                reader.onload = function(e) {
                    $('#base_image-preview').css('display', 'inline-block').attr('src', e.target.result);
                }
            }
        }

        function renderAdditionalImages(input) {
            if(input.files.length) {
                $.each(input.files, function (index, value) {
                    var reader = new FileReader;
                    reader.readAsDataURL(value);
                    reader.onload = function(e) {
                        $('[name="additional_images[]"]').after(`
                            <img src="`+e.target.result+`" alt="Additional Image" id="additional_images-preview-`+index+`" class="mt-2 img-thumbnail img-responsive d-inline-block" style="height: 150px; width: 150px;">
                        `);
                    }
                })
            }
        }

        $('#should-track').change(function() {
            if($(this).is(':checked')) {
                $('.stock-count').show();
            } else {
                $('.stock-count').hide();
            }
        });
    });
</script>
@endsection