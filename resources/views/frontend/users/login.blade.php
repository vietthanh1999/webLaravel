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

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <form action="" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="email" placeholder="Email" name="email"/>
                        <input type="password" placeholder="Password" name="password"/>
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbaoregister'))
                        <div class="alert alert-success">
                            {{session('thongbaoregister')}}
                        </div>
                    @endif
                    <form action="userregister" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text" placeholder="Name" name="name"/>
                        <input type="email" placeholder="Email Address" name="email"/>
                        <input type="password" placeholder="Password" name="password"/>
                        <input type="text" placeholder="Phone" name="phone"/>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>
@endsection
