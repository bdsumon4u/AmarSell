@foreach($childrens as $children)
    <option value="{{ $children->id }}" {{ $selected == $children->id ? 'selected' : ($disabled == $children->id ? 'disabled' : '') }}> @for($i = $depth; $i; $i--) | -- @endfor {{ $children->name }}</option>
    @include('components.categories.childrens', ['childrens' => $children->childrens, 'depth' => $depth + 1])
@endforeach