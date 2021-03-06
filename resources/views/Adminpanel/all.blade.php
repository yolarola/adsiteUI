@extends('layouts.app')

@section('content')


  <div class="container d-flex flex-nowrap ">

    @if (count($adverts->where('moderated', 0))==0)
    <H1>НЕТ ОБЪЯВЛЕНИЙ НА ПРОВЕРКУ</H1>
    @else
        @foreach ($adverts->where('moderated', 0) as $ad)



                <div class="card-deck">
                        <div class="col-4">
                                <div class="card" style="width: 10rem; ">

                                        <img class="card-img-top" src="{{asset('uploads/' . $ad->main_folder . '/' .$ad->folder . '/crops' .'/' . $ad->crop_img_main)}}" alt="Card image cap">
                                        <div class="card-body">
                                                <h5 class="card-title">{{ $ad->advert_name }}</h5>
                                                <p class="card-text">{{$ad->price . ' рублей'}}</p>
                                                <a href="{{route('adminpaneledit', [$ad->id])}}" class="card-link">Просмотр</a>
                                                <a href="{{route('adminpaneldelete', [$ad->id])}}" class="card-link">Удалить</a>
                                                <a href="{{route('adminpanelaprove', [$ad->id])}}" class="card-link">Одобрить</a>
                                        </div>
                                </div>
                        </div>
                </div>

      @endforeach
      @endif





  </div>



@endsection
