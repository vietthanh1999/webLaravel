@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card card-body">
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
                <form action="add" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>ADD COUNTRY</label>
                        <input type="text" class="form-control" name="name" placeholder="placeholder">
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

