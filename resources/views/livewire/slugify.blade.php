<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="title">Product Title</label><span class="text-danger">*</span>
            <input type="text" name="title" wire:model.debounce.250ms="title" wire:keyup="slugify" value="{{ old('title') }}" id="title" class="form-control @error('title') is-invalid @enderror">
            {!! $errors->first('title', '<span class="invalid-feedback">:message</span>') !!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="slug">SLUG</label><span class="text-danger">*</span>
            <input type="text" name="slug" value="{{ $slug }}" id="slug" class="form-control @error('slug') is-invalid @enderror">
            {!! $errors->first('slug', '<span class="invalid-feedback">:message</span>') !!}
        </div>
    </div>
</div>