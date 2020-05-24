@extends('layouts.ready')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header">Edit <strong>Reseller</strong></div>
            <div class="card-body">
                <form action="{{ route('admin.resellers.update', $reseller->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name', $reseller->name) }}" id="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" value="{{ old('email', $reseller->email) }}" id="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $reseller->phone) }}" id="phone" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection