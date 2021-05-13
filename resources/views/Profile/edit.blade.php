@extends('layouts.app')

@section('content')


        <div class="col-12">
            <label for="phoneNumber" class="form-label">Номер телефона</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="8 914 444 22 11" value ="{{$adv->phoneNumber}}">
            <div class="invalid-feedback">
               Please enter a valid email address for shipping updates.
            </div>
      </div>

@endsection      