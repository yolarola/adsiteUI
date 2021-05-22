@extends('layouts.app')

@section('content')


<form name="autocomplete-textbox" id="autocomplete-textbox" method="post" action="{{route('search')}}">
  @csrf
   <div class="form-group d-flex  ">
      <div class="col-md-1">
     <label for="exampleInputEmail1">Поиск</label>
      </div>
      <div class="col-md-8">
     <input type="text" id="q" name="q" class="form-control">
      </div>
     <button type="submit" class="btn btn-primary mb-1 ">Искать</button>
   </div>

 </form>

 <div class="dropdown mb-3">
  <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Категории
  </button>
  <form name="categorysearch" id="categorysearch" method="post" action="{{route('categorysearch')}}">
    @csrf
      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

        @foreach ($categories->where('parent_id', 0) as $category)

                      <button class="dropdown-item" disabled type="submit"> {{ $category->category_name}}</button >

                      @foreach ($categories->where('parent_id', $category->id)->where('parent_id','!=',0) as $cate)
                            <button class="dropdown-item" type="submit" name="categorysearchbutton" value = '{{$cate -> id }}'>{{ $cate->category_name}} </button >
                      @endforeach
                @endforeach

      </div>
</form>
</div>

<div class="container d-flex flex-wrap ">

    @foreach ($adverts as $ad)
    <div class="card-deck">
        <div class="col-4">
            <div class="card" style="width: 10rem; ">
                <img class="card-img-top" src="{{asset('uploads/' . $ad->main_folder . '/' .$ad->folder . '/crops' .'/' . $ad->crop_img_main)}}" alt="Card image cap">
                <div class="card-body">
                      <h5 class="card-title">{{ $ad->advert_name }}</h5>
                      <p class="card-text">{{$ad->price . ' рублей'}}</p>
                      <a href="{{route('homeshow', [$ad->id])}}" class="card-link">Просмотр</a>
                      @auth
                            @if (Auth::user()->AdminMode == 1)
                                <a href="{{ route('adminhomedelete', [$ad->id]) }}" class="card-link">Удалить</a>
                            @endif
                      @endauth
                </div>

              </div>
            </div>
    </div>

  @endforeach




</div>

@endsection
