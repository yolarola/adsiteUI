@extends('layouts.app')

@section('content')
<div class='container'>
<form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
    @method('PUT')
@csrf

<input type="text" name='category_name' value="{{ $category->category_name }}">
        <select name="parent_id" id="parent_id">
            @foreach ($categories as $category_item)
                <option {{ $category->parent_id == $category_item->id ? 'selected' : '' }} value="{{$category_item->id}}">

                    {{$category_item->category_name}}

                </option>
            @endforeach
        </select>

<button type='submit'>ff</button>
</form>
</div>

@endsection