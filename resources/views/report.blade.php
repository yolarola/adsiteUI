@extends('layouts.app')

@section('content')

@foreach ($adverts as $advert)


<form action="{{route('sendreport')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group col-12  mt-3 green-border-focus">
                <label for="report_to">Введите сообщение</label>
                <textarea class="form-control" id="report_to" name = "report_to" placeholder="Введите сообщение" rows="5" ></textarea>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <input type="text" hidden class="form-control" id="user_id" name="user_id"  value = "{{$advert->user_id}}">
                <input type="text" hidden class="form-control" id="advert_id" name="advert_id"  value = "{{$advert->id}}">
                <input type="text" hidden class="form-control" id="user_name" name="user_name"  value = "{{$advert->name}}">
                <input type="text" hidden class="form-control" id="reporter_id" name="reporter_id" value = "{{Auth::user()->id}}">
                <input type="text" hidden class="form-control" id="reporter_name" name="reporter_name" value = "{{Auth::user()->name}}">

                <button type="submit" class="btn btn-primary mb-1 mt-3 justify-content-center">Отправить сообщение</button>
        </div>

@endforeach
@endsection
