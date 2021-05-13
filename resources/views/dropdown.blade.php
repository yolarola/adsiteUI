@extends('layouts.app')

@section('content')




<div class='container'>
    <div class="container">

        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="/categories">категории</a>
            <a class="p-2 text-muted" href="/adminpanel">админпанель</a>
            <a class="p-2 text-muted" href="/adminpanel/all">админпанель all</a>
            <a class="p-2 text-muted" href="/dropdown">дропдавн</a>
      
    
          </nav>
    
    </div>
    
    <form action="/dropdown" method='post'>
        @csrf
        <input type="text" name='category_name'>
        <select name="parent_id" id="parent_id">
            @foreach ($categories as $category)
                <option value="{{$category -> id}}">
                
                    {{$category -> category_name}}

                </option>
            @endforeach
        </select>

        <button type='submit'>OO</button>
    </form>

</div>

<div class="form-group">
          <label for="categories_selected">Example multiple select</label>
          <form action="/dropdown-req" method='post'>
          @csrf
          <select multiple class="form-control" id="categories_selected" name="categories_selected">

          @foreach ($categories->where('parent_id', 0) as $category)

                    <option disabled> {{ $category->category_name}} {{'----------------------------------------------------------------'}}</option >

                    @foreach ($categories->where('parent_id', $category->id) as $cate)

                          <option value = '{{$cate -> id }}' >{{'------'}} {{ $cate->category_name}} </option >

                    @endforeach
                    
          @endforeach
       
          </select>
          <button type='submit'>OO</button>


          <div class="form-group mb-5">
            <div class="d-flex align-items-start">
                  <div class="container">
                        <input type="file" class="form-control-file mt-5" name="img_2" id="img_2" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">файл не больше 2мб.</small>
                  </div>
                  <div class="container">
                        <div class="profile-header-img mt-3">
                               <img class="rounded-circle" src="{{asset('images/' . $user = Auth::user()->avatar)}}" />
                        </div>
                  </div>
          </div>
      </div>
      </div>
          
    </form>
    </div>















    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Dependent Dropdown</h3>
                <hr>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control input-sm" name="category_id">
                        <option value="">--select--</option>
                        @foreach ($categories as $row)
                            <option value="{{$row->id}}">{{$row->category_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="position:relative">
                    <label>SubCategory</label>
                    <select class="form-control input-sm" name="subcategory_id"></select>
                    <img id="loader" src="{{url('/images/ajax-loader.gif')}}" alt="loader">
                </div>

            </div>
        </div>
    </div>

    <style>
        #loader {
            position: absolute;
            right: 18px;
            top: 30px;
            width: 20px;
        }
    </style>
   
<script> 
$(function () {
    var loader = $('#loader'),
        category = $('select[category_name="category_id"]'),
        subcategory = $('select[category_name="subcategory_id"]');

    loader.hide();
    subcategory.attr('disabled','disabled')

    subcategory.change(function(){
        var id = $(this).val();
        if(!id){
            subcategory.attr('disabled','disabled')
        }
    })

    category.change(function() {
        var id= $(this).val();
        if(id)
        {
            loader.show();
            subcategory.attr('disabled','disabled')

            $.get('{{url('/dropdown-data?id=')}}'+id)
                .success(function(data)
                {
                    var s='<option value="">---select--</option>';
                    data.forEach(function(row)
                    {
                        s +='<option value="'+row.id+'">'+row.category_name+'</option>'
                    })
                    subcategory.removeAttr('disabled')
                    subcategory.html(s);
                    loader.hide();
                })
        }

    })
})
</script>


@endsection