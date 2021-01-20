@extends('layouts.index')

@section('content')
<div class="col-sm-1">
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="id">Id</td>
                            <td class="name">Name</td>
                            <td class="iamge">Image</td>
                            <td class="price">Price</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="cart_id">
                                    <p>{{$product->id}} </p>
                                </td>
                                <td class="cart_name">
                                    <p>{{$product->name}} </p>
                                </td>
                                <td class="cart_product">
                                    <a href=""> <img src="{{URL::asset('upload/product/'. $iduser .'/50x70'. json_decode($product->image)[0] )}}" alt="Image  product" ></a>
                                </td>
                                <td class="cart_price">
                                    <p>{{$product->price}}VND</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_edit" href="{{URL::asset('editproduct/'. $product->id)}}"><i class="fa fa-times"></i>Edit</a>
                                    <a class="cart_quantity_delete" href="{{URL::asset('deleteproduct/'. $product->id)}}"><i class="fa fa-times"></i>Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <a class="btn btn-default update" href="addproduct">Add</a>
        </div>


    </section> <!--/#cart_items-->
</div>
@endsection
