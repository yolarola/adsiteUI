@extends('layouts.app')

@section('content')


<div class="container">
    @foreach ($adverts as $adv)
    <h2 align="center">{{$adv->advert_name}}</h2>    
    
    <div class="row d-flex justify-content-md-center mt-5">
      <div class="col-xs-2">
    <img style="width: 100%; height: 100%; margin-right: 10%" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_main)}}" alt="Img_main">
  </div>  
  <div class="col-xs-2">
    <img style="width: 100%; height: 100%; margin-right: 10%" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_2)}}" alt="Img_2" alt="img_2">
  </div>
  <div class="col-xs-2">
    <img style="width: 100%; height: 100%" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_3)}}" alt="Img_3" alt="img_3">  
  </div> 
    </div>

    <h3>{{$adv->firstName}}</h3>
    <p>{{$adv->AdvertText}}</p>
    <div class="container mt-4">
   
    <p>Номер телефона: {{$adv->phoneNumber}}</p>
    <p>Цена: {{$adv->price}} рублей</p>

    <a href="{{route('messagesshow', $adv->user_id)}}" class="card-link">Написать сообщение</a>
    </div>
  </div>



  @endforeach
@endsection