@extends('layouts.app')

@section('content')

<div id="list-example" class="list-group">
@foreach ($adverts as $advert)
    <a class="list-group-item list-group-item-action" href="{{route('messagesshow', [$advert->user_id, $advert->advert_id])}}">{{$advert->id}} | {{ $advert->advert_id }} | {{$advert->advert_name }} | {{$advert->name}} |  {{$advert->message}} | {{$advert->created_at}}</a>
@endforeach
</div>

    
 
  

@endsection