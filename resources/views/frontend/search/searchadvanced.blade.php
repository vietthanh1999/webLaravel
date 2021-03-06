@extends('layouts.custom')

@section('content')

<section id="form"><!--form-->
    <div class="container">
       <div class="row">
        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Features Items</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search_box">
                                <form action="{{URL::asset('searchadvanced')}}" method="post">
                                    <ul style="list-style: none; margin: 0; padding: 0; display: inline-block">
                                        <li style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        </li>
                                        <li style="display: inline-block;">
                                            <input type="text" placeholder="Search" name="keywork"/>
                                        </li>
                                        <li style="display: inline-block;">
                                            <select id="select_price" class="form-control form-control-line" name="price" >
                                                <option value="">Choose price</option>
                                                <option value="0">0-100</option>
                                                <option value="1">100-200</option>
                                                <option value="2">200-300</option>
                                                <option value="3">300-400</option>
                                                <option value="4">400-500</option>
                                                <option value="5">500-600</option>
                                            </select>
                                        </li>
                                        <li style="display: inline-block;">
                                            <select class="form-control form-control-line" name="category">
                                            <option value="">Choose category</option>
                                            @foreach ($category as $item)
                                                <option value="{{$item->id}}">{{$item->name}} </option>
                                            @endforeach
                                        </select></li>
                                        <li style="display: inline-block;">
                                            <select class="form-control form-control-line" name="brand">
                                            <option value="">Choose brand</option>
                                            @foreach ($brand as $item)
                                                <option value="{{$item->id}}">{{$item->name}} </option>
                                            @endforeach
                                            </select>
                                        </li>
                                        <li style="display: inline-block;">
                                            <select id="select_sale" class="form-control form-control-line" name="status" >
                                                <option value="">Choose Status</option>
                                                <option value="0">New</option>
                                                <option value="1">Sale</option>
                                            </select>
                                        </li>
                                    </ul>

                                    <button class="btn btn-warning" type="submit">Search</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div> <br/>

                @foreach ($product as $item)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::asset('upload/product/'. $item->iduser .'/200x300'. json_decode($item->image)[0])}}" alt="" />
                                <h2>{{$item->price}} </h2>
                                <p>{{$item->name}}</p>
                                <a  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>{{$item->price}} </h2>
                                    <p>{{$item->name}}</p>
                                    <a id="{{$item->id}} " class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="{{URL::asset('productdetail/'. $item->id)}}"><i class="fa fa-plus-square"></i>Product Detail</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- {!! $product->links() !!} --}}


                {{-- <ul class="pagination">
                    <li class="active"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">&raquo;</a></li>
                </ul> --}}
            </div><!--features_items-->
        </div>
       </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $('.add-to-cart').click(function(){
        var getID = $(this).attr('id');

        console.log(getID);
        $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxcart",
                type:"POST",
                data:{
                    id: getID
                },
                success:function(response){
                     console.log(Object.entries(response));
                     $('#numcart').html(Object.entries(response).length);
                },
            });
    });
});
</script>
@endsection
