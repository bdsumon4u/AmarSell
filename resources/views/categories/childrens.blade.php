@foreach($childrens as $children)
<option value=""> @for($i = $depth; $i; $i--) |-- @endfor {{ $children->name }}</option>
@include('categories.childrens', ['childrens' => $children->childrens, 'depth' => $depth + 1])
@endforeach