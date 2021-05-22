@extends('layouts.app')

@section('content')



        <div class="container">
            <nav class="nav d-flex justify-content-between">
              <a class="p-2 text-muted" href="/myads">мои объявления</a>
              <a class="p-2 text-muted" href="/profile">мой профиль</a>
          </nav>
          </div>


       <div class="card">
       <div class="card-header">{{ __('Аватарка профиля') }}</div>
       <div class="card-body">
        <div class="row justify-content-center">

            <div class="profile-header-container mt-3">
                <div class="profile-header-img mb-3">
                    <img class="rounded-circle" src="{{asset('images/' . $user->avatar)}}" />
                    <!-- badge -->

                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <form action="{{route('update_avatar')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Пожалуйста, выберите файл изображения. размер должен быть не больше 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Загрузить</button>
            </form>

        </div>



            <form action="{{route('UserUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="col-12">
                <label for="phoneNumber" class="form-label">Логин</label>
                <input type="text" class="form-control" id="name" name="name"  value ="{{$user->name}}">
                <div class="invalid-feedback">
                   Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="col-12">
                <label for="phoneNumber" class="form-label">Имя</label>
                <input type="text" class="form-control" id="firstName" name="firstName"  value ="{{$user->firstName}}">
                <div class="invalid-feedback">
                   Please enter a valid email address for shipping updates.
                </div>
          </div>

          <div class="col-12">
            <label for="phoneNumber" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="lastName" name="lastName"  value ="{{$user->lastName}}">
            <div class="invalid-feedback">
               Please enter a valid email address for shipping updates.
            </div>
      </div>

      <div class="col-12">
        <label for="phoneNumber" class="form-label">Номер телефона</label>
        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"  value ="{{$user->phoneNumber}}">
        <div class="invalid-feedback">
           Please enter a valid email address for shipping updates.
        </div>
  </div>

  <input type="text" hidden class="form-control" id="id" name="id" placeholder="Введите название" value = "{{$user->id}}">
<button type="submit" class="btn btn-primary mb-2 mt-3">Обновить</button>
            </form>

    </div>
    </div>


    <ul>



@endsection


