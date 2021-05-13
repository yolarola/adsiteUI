@extends('layouts.app')

@section('content')

<div class='container'>
    <form action="{{ route('categories.store') }}" method='post'>
        @csrf
        <input type="text" name='category_name'>
        <select name="parent_id" id="parent_id">
            @foreach ($categories as $category)
                <option value="{{$category -> id}}">
                
                    {{$category -> category_name}}

                </option>
            @endforeach
        </select>

        <button type='submit'>OO</button>
    </form>

</div>

@endsection