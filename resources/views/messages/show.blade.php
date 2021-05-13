@extends('layouts.app')

@section('content')


<div class="container">

@foreach ($adverts as $advert)
@foreach ($messages
 as $message)

<h1 align="@if ($message->sender_id == Auth::user()->id) right @elseif ($message->reciever_id == Auth::user()->id) right @else left @endif">{{ $message->message}}</h1>


@endforeach


</div>

<form action="{{route('sendmessage',$advert->user_id)}}" method="post" enctype="multipart/form-data">
    @csrf


<div class="form-group col-12  mt-3 green-border-focus">
    <label for="message_to">Введите сообщение</label>
    <textarea class="form-control" id="message_to" name = "message_to" placeholder="Введите сообщение" rows="5" ></textarea>
  </div>

  <div class="d-grid gap-2 d-md-flex justify-content-md-center">
    <button type="submit" class="btn btn-primary mb-1 mt-3 justify-content-center">Отправить сообщение</button>
 </div>
 <input type="text" hidden class="form-control" id="sender_id" name="sender_id" value="{{Auth::user()->id}}" required="">
 <input type="text" hidden class="form-control" id="reciever_id" name="reciever_id" value="{{$advert->user_id}}" required="">
 <input type="text" hidden class="form-control" id="userid" name="userid" value="{{$advert->user_id}}" required="">
</form>
@endforeach
@endsection