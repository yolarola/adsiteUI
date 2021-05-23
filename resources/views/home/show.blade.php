@extends('layouts.app')

@section('content')


<div class="container">
    @foreach ($adverts as $adv)
    <h2 align="center">{{$adv->advert_name}}</h2>

    <div class="row d-flex justify-content-md-center mt-5">
      <div class="col-4">
    <img style="width: 100%; height: 100%; margin-right: 10%" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_main)}}" class="rounded " alt="Img_main">
  </div>
  <div class="col-4">
    <img style="width: 100%; height: 100%; margin-right: 10%" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_2)}}" class="rounded " alt="Img_2" alt="img_2">
  </div>
  <div class="col-4">
    <img style="width: 100%; height: 100%" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_3)}}" class="rounded " alt="Img_3" alt="img_3">
  </div>
    </div>
{{-- col-xs-2--}}
    <h3><a href="{{route('userprofile',$adv->user_id)}}"> {{$adv->name}} </a></h3>
    <p>{{$adv->AdvertText}}</p>
    <div class="container mt-4">

    <p>Номер телефона: {{$adv->phoneNumber}}</p>
    <p>Цена: {{$adv->price}} рублей</p>
    @auth
        @if ($adv->user_id != Auth::user()->id)

        <a href="{{route('messagesshow', [$adv->user_id, $adv_id = $adv->id])}}" class="card-link">Написать сообщение</a>

        @endif


            @if (Auth::user()->id == $adv->user_id)
                     <a href="{{ route('archive', [$adv_id = $adv->id]) }}" class="card-link">Снять с публикации</a>
            @endif

            @if ($adv->user_id != Auth::user()->id)
            <a href="{{ route('report', [$adv_id = $adv->user_id]) }}" class="card-link">Пожаловаться</a>
            @endif

    @endauth
    </div>
  </div>



  @endforeach
@endsection
