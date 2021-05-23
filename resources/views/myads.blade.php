@extends('layouts.app')

@section('content')

<div class="container">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="/myads">мои объявления</a>
      <a class="p-2 text-muted" href="/profile">мой профиль</a>
  </nav>
  </div>


  <div class="container d-flex flex-wrap ">

    @foreach ($adverts->where('user_id', Auth::user()->id) as $ad)

            <div class="card-deck">
                <div class="col-4">
                    <div class="card" style="width: 10rem; ">
                            <img class="card-img-top" src="{{asset('uploads/' . $ad->main_folder . '/' .$ad->folder . '/crops' .'/' . $ad->crop_img_main)}}" alt="Card image cap">
                            <div class="card-body">
                                    <h5 class="card-title">{{ $ad->advert_name }}</h5>
                                    <p class="card-text">{{$ad->price . ' рублей'}}</p>

                                    @if (Auth::user()->id == $ad->user_id)
                                         <a href="{{ route('archive', [$ad_id = $ad->id]) }}" class="card-link">Снять с публикации</a>
                                    @endif
                                    <a href="{{route('adedit', [$ad->id])}}" class="card-link">Редактировать</a>
                                    <a href="{{route('addelete', [$ad->id])}}" class="card-link">Удалить</a>
                            </div>

                    </div>
                </div>
            </div>
  @endforeach
@endsection
