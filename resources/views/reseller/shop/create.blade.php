@extends('layouts.ready')

@section('styles')
<style>
    #logo {
        width: 100%;
    }
    #logo-preview {
        max-width: 100%;
        max-height: 70px;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <form action="{{ route('reseller.shops.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card rounded-0 shadow-sm">
                <div class="card-header"><strong>Create New Shop</strong>
                    <div class="card-header-actions"><button type="submit" class="card-header-action btn btn-success text-light">Submit</button></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label><span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label><span class="text-danger">*</span>
                                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label><span class="text-danger">*</span>
                                        <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="logo">Shop Logo</label>
                                <input type="file" name="logo" value="{{ old('logo') }}" id="logo" class="@error('logo') is-invalid @enderror">
                                @error('logo')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                                <img id="logo-preview" class="mt-2" src="" alt="Logo" class="img-responsive img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Short Description</label><span class="text-danger">*</span>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $("#logo").change(function(){
        renderLogo(this);
    });

    function renderLogo(input)
    {
        if(input.files && input.files[0])
        {
            var reader = new FileReader;
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e){
                $('#logo-preview').attr('src', e.target.result)
            };
        }
    }
</script>
@endsection