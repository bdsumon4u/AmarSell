@foreach($childrens as $children)
    <option value="{{ $children->id }}" {{ request('active_id', 0) == $children->id ? 'disabled' : (($active->parent->id ?? 0) == $children->id ? 'selected' : '') }}> @for($i = $depth; $i; $i--) | -- @endfor {{ $children->name }}</option>
    @include('categories.parent-option-childrens', ['childrens' => $children->childrens, 'depth' => $depth + 1])
@endforeach