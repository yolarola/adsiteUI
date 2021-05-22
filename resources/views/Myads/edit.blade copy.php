@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      @if ($message = Session::get('success'))

          <div class="alert alert-success alert-block">

              <button type="button" class="close" data-dismiss="alert">×</button>

              <strong>{{ $message }}</strong>

          </div>

      @endif

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
  </div>

  <div class="container">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="/myads">мои объявления</a>
      <a class="p-2 text-muted" href="/profile">мой профиль</a>
  </nav>
  </div>



@foreach ($adverts as $adv)  


<div class="card">
       <div class="card-header">{{ __('Изображения') }}</div>
       <div class="card-body">
  
        <div class="row justify-content-left">
            <form action="{{route('MyadUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card mt-2">
              
                      <div class="form-group mb-5">
                            <div class="d-flex align-items-start">
                                <div class="container">
                                      <input type="file" class="form-control-file mt-5" name="img_main" id="img_main" aria-describedby="fileHelp">
                                      <small id="fileHelp" class="form-text text-muted">файл не больше 2мб.</small>
                                </div>
                                <div class="container">
                                      <div class="profile-header-img mt-3">
                                          <img class="rounded-circle" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_main)}}" />
                                      </div>
                                </div>
                          </div>
                      </div>
                </div>

                <div class="card mt-2">
              
              <div class="form-group mb-5">
                    <div class="d-flex align-items-start">
                          <div class="container">
                                <input type="file" class="form-control-file mt-5" name="img_2" id="img_2" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">файл не больше 2мб.</small>
                          </div>
                          <div class="container">
                                <div class="profile-header-img mt-3">
                                       <img class="rounded-circle" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_2)}}" />
                                </div>
                          </div>
                  </div>
              </div>
              </div>

              <div class="card mt-2">
              
              <div class="form-group mb-5">
                <div class="d-flex align-items-start">
                  <div class="container">
                      <input type="file" class="form-control-file mt-5" name="img_3" id="img_3" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">файл не больше 2мб.</small>
                  </div>
                      <div class="container">
                        <div class="profile-header-img mt-3">
                            <img class="rounded-circle" src="{{asset('uploads/' . $adv->main_folder . '/' .$adv->folder . '/crops' .'/' . $adv->crop_img_3)}}" />
                        </div>
                      </div>
              </div>
              </div>
              </div>
             
           

            
        
    
    </div>
   
    
<div class="col-md-7 col-lg-8">
      <h4 class="mb-3">Данные об объявлении</h4>
      <div class="row g-3">

            <div class="col-12">
                  <label for="AdvertName" class="form-label">Название объявления</label>
                  <input type="text" class="form-control" id="AdvertName" name="AdvertName" placeholder="Введите название" value ="{{$adv->advert_name}}">
                  <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                  </div>
            </div>

         

            <div class="form-group col-12  mt-3 green-border-focus">
              <label for="Adverttext">Текст объявления</label>
              <textarea class="form-control" id="Adverttext" name = "Adverttext" placeholder="Введите текст объявления"  rows="5" >{{$adv->AdvertText}}</textarea>
            </div>


            <div class="col-sm-6">
                  <label for="firstName" class="form-label">Имя</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Введите свое имя" value ="{{$adv->firstName}}" required="">
                  <div class="invalid-feedback">
                       Valid first name is required.
                  </div>
            </div>

            <div class="col-sm-6">
                  <label for="adress" class="form-label">Адрес</label>
                  <input type="text" class="form-control" id="adress" name="adress" placeholder="Введите свой адрес" value="{{$adv->adress}}" required="">
                  <div class="invalid-feedback">
                       Valid last name is required.
                  </div>
            </div>


          <div class="form-group col-12  mt-3">
              <label for="AdvertCategory">Выбор категории</label>
              <select multiple class="form-control" id="AdvertCategory" name="AdvertCategory">
                   
                   
               @foreach ($categories->where('parent_id', 0) as $category)

                    <option disabled> {{ $category->category_name}} {{'----------------------------------------------------------------'}}</option >

                    @foreach ($categories->where('parent_id', $category->id) as $cate)
                          @if ($cate ->id == $adv->AdvertCategory)
                          <option selected value = '{{$cate -> id }}' >{{'------'}} {{ $cate->category_name}}</option >
                          @else
                          <option value = '{{$cate -> id }}' >{{'------'}} {{ $cate->category_name}} </option >
                          @endif  
                    @endforeach
          
              @endforeach

              </select>
        </div>
       
        


        <div class="col-12">
              <label for="phoneNumber" class="form-label">Номер телефона</label>
              <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="8 914 444 22 11" value ="{{$adv->phoneNumber}}">
              <div class="invalid-feedback">
                 Please enter a valid email address for shipping updates.
              </div>
        </div>

        <div class="col-12">
              <label for="price" class="form-label">Цена</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="5000rub" required="" value ="{{$adv->price}}">
              <div class="invalid-feedback">
                   Please enter your shipping address.
              </div>
        </div>

        <input type="text" hidden class="form-control" id="id" name="id" placeholder="Введите название" value = "{{$adv->id}}">
          <hr class="my-4 mt-3">
          <hr class="my-4 mt-5">
          
          <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <button type="submit" class="btn btn-primary mb-1 mt-3 justify-content-center">Предпросмотр изображений</button>
         </div>

        </form>

      </div>
</div>
</div>

@endforeach
@endsection