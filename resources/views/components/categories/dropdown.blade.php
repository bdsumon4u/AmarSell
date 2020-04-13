<select selector name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" id="{{ $id ?? '' }}" class="form-control" {{ ($multiple ?? false) == 'true' ? 'multiple' : '' }}>
    @if(($multiple ?? false) != 'true')    
    <option value="">{{ $placeholder }}</option>
    @endif
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ request('active_id', 0) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @include('components.categories.childrens', ['childrens' => $category->childrens, 'depth' => 1])
    @endforeach
</select>