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


    .input-group {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        padding: 5px;
        box-sizing: content-box;
    }
    .input-group * {
        border-radius: 0;
    }
    .input-group-append {
        cursor: pointer;
    }
    .input-group input, .input-group select {
        /* margin-right: 1rem; */
    }
    /* @media (max-width: 768px) { */
        .input-group input, .input-group select {
            min-width: 250px !important;
            max-width: 450px !important;
        }
    /* } */
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header py-2">Admin <strong>Settings</strong></div>
            <div class="card-body p-2">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <ul class="nav nav-tabs list-group" role="tablist">
                            <li class="nav-item rounded-0"><a class="nav-link active" data-toggle="tab" href="#item-1">General</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link" data-toggle="tab" href="#item-2">Social</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link" data-toggle="tab" href="#item-3">Password</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-8 col-xl-9">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                                    <div class="tab-content">
                                        @csrf
                                        @method('PATCH')
                                        <div class="tab-pane active" id="item-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">General</small></h4>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company-name">Company Name</label>
                                                        <input type="text" name="company[name]" id="company-name" value="{{ old('company.name', $company->name ?? '') }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company-email">Company Email</label>
                                                        <input type="text" name="company[email]" id="company-email" value="{{ old('company.email', $company->email ?? '') }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="company-address">Company Address</label>
                                                        <input type="text" name="company[address]" id="company-address" value="{{ old('company.address', $company->address ?? '') }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                        <div class="tab-pane" id="item-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Social</small></h4>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-facebook"></i></span>
                                                        </div>
                                                        <input type="text" name="social[facebook]" value="{{ old('social.facebook', $social->facebook ?? '') }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                                                        </div>
                                                        <input type="text" name="social[twitter]" value="{{ old('social.twitter', $social->twitter ?? '') }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                                                        </div>
                                                        <input type="text" name="social[instagram]" value="{{ old('social.instagram', $social->instagram ?? '') }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                                                        </div>
                                                        <input type="text" name="social[youtube]" value="{{ old('social.youtube', $social->youtube ?? '') }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="item-3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Password</small></h4>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">Password</label><span class="text-danger">*</span>
                                                        <input type="password" name="password" value="{{ old('password') }}" id="" class="form-control @error('password') is-invalid @enderror">
                                                        {!! $errors->first('password', '<span class="invalid-feedback">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirm Password</label><span class="text-danger">*</span>
                                                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="" class="form-control @error('password_confirmation') is-invalid @enderror">
                                                        {!! $errors->first('password_confirmation', '<span class="invalid-feedback">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="old_password">Old Password</label><span class="text-danger">*</span>
                                                        <input type="password" name="old_password" value="{{ old('old_password') }}" id="" class="form-control @error('old_password') is-invalid @enderror">
                                                        {!! $errors->first('old_password', '<span class="invalid-feedback">:message</span>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0">
                                                    <button type="submit" formaction="{{ route('admin.password.update') }}" class="btn btn-success">Change Password</button>
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