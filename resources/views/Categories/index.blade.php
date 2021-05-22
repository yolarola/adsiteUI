@extends('layouts.app')

@section('content')


<a href="{{ route('categories.create') }}">Создать</a>

<ul>
                    @foreach ($categories as $category)

                        <li>
                            {{ $category->category_name }} ({{ $category->parent->category_name }}) |
                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}">Редактировать</a> |
                            <a href="{{ route('categories.show', ['category' => $category->id]) }}">Просмотр</a>
                        </li>

                    @endforeach
                </ul>


@endsection
