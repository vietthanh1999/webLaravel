@extends('layouts.index')

@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text" name="name" placeholder="Name" value={{$user->name}} />
                        <input type="email" name="email" placeholder="Email Address" value={{$user->email}} readonly >
                        <input type="password" name="password" placeholder="Password" value="" >
                        <input type="text" name="phone" placeholder="Phone" value="{{$user->phone}} " >
                        <input type="address" name="address" placeholder="Address" value={{$user->address}}>
                        {{-- <input type="country" name="country" placeholder="Country" value={{$user->country}}> --}}
                        <input type="file" placeholder="Avatar" name="avatar" >
                        <img src="{{'upload/user/avatar/'. $user->avatar}}" alt="" width="200" height="200">
                        <button type="submit" class="btn btn-default">Cập nhật thông tin</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
