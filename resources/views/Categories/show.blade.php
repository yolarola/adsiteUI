@extends('layouts.app')

@section('content')
<div class='container'>
    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
        @method('DELETE')
    @csrf

        <p>{{ $category->category_name }}</p>

                <p>{{ $category->parent->category_name }} </p>
              
           

    <button type='submit'>ff</button>
    </form>
</div>
@endsection