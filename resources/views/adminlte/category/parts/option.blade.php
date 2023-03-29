@foreach($childrens as $children)
    @php
        $isEditPage = false;
        if(!empty($category)){
            if($children->id === $category->parent_id){
                $isEditPage = true;
            }
        }

    @endphp
    <option value="{{$children->id}}" {{($isEditPage) ? 'selected' : ''}}>
        {!! str_repeat('&nbsp', $count) !!}{{$children->title}}
    </option>
    @if(count($children->childrenRecursive) > 0)
        @include('adminlte.category.parts.option', ['childrens' => $children->childrenRecursive, 'count' => $count+3])
    @endif
@endforeach

