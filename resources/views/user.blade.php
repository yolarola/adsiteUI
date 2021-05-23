@extends('layouts.app')

@section('content')


<div class="container">

    @foreach ($users as $us)

       <div class="card">
        <div class="card-header">{{ __('Информация о пользователе') }}</div>
        <div class="card-body">
         <div class="row justify-content-center">

             <div class="profile-header-container mt-3">
                 <div class="profile-header-img mb-3">
                     <img class="rounded-circle" src="{{asset('images/' . $us->avatar)}}" />
                     <!-- badge -->

                 </div>
                 <h2>Ник: {{$us->name}}</h2>
                 <h2>Имя: {{$us->firstName}}</h2>
                 <h3>Фамилия: {{$us->lastName}}</h3>
             </div>


            </div>
            <div class="container mb-2">
                @if ($us->id != Auth::user()->id)
            <a href="{{ route('reportuser', [$us->id]) }}" class="card-link">Пожаловаться</a>
            @endif
            </div>




            @foreach ($reviews as $review)

                | Имя: <object> <a href="{{route('userprofile',$review->reviewer_id)}}"> {{$review->reviewer_name}} </a> </object> | Отзыв:  {{$review->review}}  </br> Дата:  {{$review->created_at}}
                </br>
                </br>
                {{--{{$advert->id}} | {{ $advert->advert_id }} | {{$advert->advert_name }} | {{$advert->name}} |  {{$advert->message}} | {{$advert->created_at}}--}}

            </a>
             @endforeach

        @if ($us->id != Auth::user()->id)
                    <form action="{{route('sendreview')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group col-12  mt-3 green-border-focus">
                                <label for="review_to">Введите сообщение</label>
                                <textarea class="form-control" id="review_to" name = "review_to" placeholder="Введите сообщение" rows="5" ></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <input type="text" hidden class="form-control" id="user_id" name="user_id"  value = "{{$us->id}}">
                                <input type="text" hidden class="form-control" id="reviewer_id" name="reviewer_id" value = "{{Auth::user()->id}}">
                                <input type="text" hidden class="form-control" id="reviewer_name" name="reviewer_name" value = "{{Auth::user()->name}}">

                                <button type="submit" class="btn btn-primary mb-1 mt-3 justify-content-center">Отправить сообщение</button>
                        </div>
        @endif
    @endforeach

</div>


@endsection
