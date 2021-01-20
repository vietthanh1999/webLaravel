
@extends('layouts.index')

@section('content')

<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>Add Product</h2>
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
        <form action="addproduct" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="text" placeholder="Name" name="name"/>
            <input type="file" placeholder="Image" name="image[]" multiple >
            <input type="text" placeholder="Price" name="price"/>
            {{-- <input type="text" placeholder="Category" name="category"/> --}}
            <select class="form-control form-control-line" name="category">
                <option value="">Choose category</option>
                @foreach ($category as $item)
                    <option value="{{$item->id}}">{{$item->name}} </option>
                @endforeach
            </select>
            {{-- <input type="text" placeholder="Brand" name="brand"/> --}}
            <select class="form-control form-control-line" name="brand">
                <option value="">Choose brand</option>
                @foreach ($brand as $item)
                    <option value="{{$item->id}}">{{$item->name}} </option>
                @endforeach
            </select>
            <select id="select_sale" class="form-control form-control-line" name="sale" >
                <option value="">Choose Sale</option>
                <option value="0">New</option>
                <option value="1">Sale</option>
            </select>
            <input id="input_persent_sale" type="text" placeholder="% Sale" name="persentsale" value="0" style="visibility: hidden;"/>
            <button type="submit" class="btn btn-default">Signup</button>
        </form>
    </div><!--/sign up form-->
</div>
<script>
//     function showPersentSale(){
//         d = document.getElementById("select_sale").value;
//         alert(d);
//     }
// });
$('#select_sale').change(function(){
    if($(this).val() == 1){
        $('#input_persent_sale').css("visibility","visible")
    };
})
</script>
@endsection
