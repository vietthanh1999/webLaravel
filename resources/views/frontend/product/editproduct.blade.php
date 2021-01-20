
@extends('layouts.index')

@section('content')

<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>Edit Product</h2>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="text" placeholder="Name" name="name" value="{{$product->name}} " />
            <input type="file" placeholder="Image" name="image[]" multiple >
            <ul>

            @foreach (json_decode($product->image) as $item)

            <li style="display: inline-block;">
                <img src="{{URL::asset('upload/product/'. $iduser .'/50x70'. $item)}}" alt="Image  product" >
                <input type="checkbox" name="checkbox[]" value="{{$item}} " />
            </li>
                @endforeach
            </ul>

            <input type="text" placeholder="Price" name="price" value="{{$product->price}} "/>
            <input type="text" placeholder="Category" name="category" value="{{$product->category}} " />
            <input type="text" placeholder="Brand" name="brand" value="{{$product->brand}} " />
            <input type="text" placeholder="Sale" name="sale" value="{{$product->sale}}" />
            <button type="submit" class="btn btn-default">Signup</button>
        </form>
    </div><!--/sign up form-->
</div>


@endsection
