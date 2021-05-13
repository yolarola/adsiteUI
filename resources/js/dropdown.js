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

            $.get('{{url('/dropdown-data?cat_id=')}}'+id)
                .success(function(data)
                {
                    var s='<option value="">---select--</option>';
                    data.forEach(function(row)
                    {
                        s +='<option value="'+row.id+'">'+row.name+'</option>'
                    })
                    subcategory.removeAttr('disabled')
                    subcategory.html(s);
                    loader.hide();
                })
        }

    })
})
