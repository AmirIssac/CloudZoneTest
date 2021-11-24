<!DOCTYPE html>
<html dir="rtl" lang="ar">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- Alerts -->
        <link rel="stylesheet" href="{{asset('alerts/style.css')}}"/>
        <!-- Styles -->
        <style>
            body *{
               //
            }
            .main-color{
                color : #563d7c;
            }
            .main-button,#my-favorite-btn{
                background-color: #563d7c;
                color: white;
                width: 18rem;
                border:2px solid white;
                border-radius: 5px;
            }
            .empty{
                color: #c0bfc2;
            }
            .fill{
                color: #563d7c;
            }
            #favorite{
                background: none;
                padding: 0px;
                border: none;
            }
            #my-favorite-btn{
                width: 20rem;
            }
            .displaynone{
                display: none;
            }
        </style>
        <div class="container">
            <div class="row align-items-center justify-content-center d-flex flex-column m-3">
                @if(!$product->is_favorite)
                <button class="displaynone" id="my-favorite-btn"> قائمة الأمنيات </button>
                @else
                <button id="my-favorite-btn"> قائمة الأمنيات </button>
                @endif
            </div>
            <div class="row align-items-center justify-content-center">
                    <div class="card" style="width: 25rem; height: 25rem">
                        <div class="card-body">
                          <h5 class="card-title main-color">معلومات المنتج</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{$product->description}}</h6>
                          <input type="hidden" value="{{$product->id}}" id="product-id">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">اللون</span>
                            </div>
                            <select name="color" id="color" class="form-control">
                                @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->name}}</option>
                                @endforeach
                            </select>
                          </div>
                            <span>السعر</span>
                            <div class="input-group mb-3">
                            <input type="number" step="0.1" class="form-control" value="{{$product->price}}" id="price">
                            <span class="input-group-text">ر.س</span>
                          </div>
                          <div>
                              <button  class="main-button">اضافة للسلة</button>
                              <button  id="favorite">
                                @if(!$product->is_favorite)
                                <i class="fas fa-heart fa-2x empty"></i>
                                @else
                                <i class="fas fa-heart fa-2x fill"></i>
                                @endif
                              </button>
                        </div>
                      </div>
        </div>
        </div>
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{asset('alerts/cute-alert.js')}}"></script>
        <script>
            $('#favorite').on('click',function(){
                var product_id = $('#product-id').val();
                if($('.fa-heart').hasClass("empty")){   // لا نقوم بالاضافة للمفضلة حتى نتأكد انها عملية اضافو وليست ازالة عكسية
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '/add/product/to/myfavorite/'+product_id,
                        data: {
                                color : $('#color').val(),
                                price : $('#price').val(),
                        },
                        success: function(data){ 
                                $('.fa-heart').removeClass('empty').addClass('fill');
                                $('#my-favorite-btn').removeClass('displaynone');
                        }
                });  // end ajax
                }
                else{
                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '/add/product/to/myfavorite/'+product_id,
                        // no data in canceling the favorite
                        success: function(data){ 
                                $('.fa-heart').removeClass('fill').addClass('empty');
                                $('#my-favorite-btn').addClass('displaynone');
                        }
                    });  // end ajax
                }
            });

            $('#my-favorite-btn').on('click',function(){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "GET",
                        url: '/show/my/favorite',
                        success: function(data){
                            cuteAlert({
                                    type: "info",
                                    title: "المنتج المفضل",
                                    message: "المواصفات : "+data.description+
                                             " , اللون "+data.color.name+
                                             ", السعر "+data.price,
                                    buttonText: "حسنا",
                                });
                        }
                }); // end ajax
            });
        </script>
    </body>
</html>
