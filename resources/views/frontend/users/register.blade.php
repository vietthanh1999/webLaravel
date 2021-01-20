@extends('layouts.index')

@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">

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

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <form action="userregister" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text" placeholder="Name" name="name"/>
                        <input type="email" placeholder="Email Address" name="email"/>
                        <input type="password" placeholder="Password" name="password"/>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>
@endsection
