@extends('layouts.app')

@section('content')

<div class="container">

    <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="/categories">категории</a>
        <a class="p-2 text-muted" href="/adminpanel">админпанель</a>
        <a class="p-2 text-muted" href="/adminpanel/all">админпанель all</a>
        <a class="p-2 text-muted" href="/dropdown">дропдавн</a>
  

      </nav>

</div>

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