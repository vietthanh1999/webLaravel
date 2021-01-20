@extends('layouts.index')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-sm-9">
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From our Blog</h2>
                <div class="single-blog-post">
                    <h3>{{$blog->title}} </h3>
                    <input id="idblog" type="hidden" value="{{$blog->id}}"/>
                    <div class="post-meta">
                        <ul>
                            <li><i class="fa fa-user"></i> Mac Doe</li>
                            <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                            <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                        </ul>

                        <div class="rate">
                            <div class="vote">
                                {{-- <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                <div class="star_5 ratings_stars"><input value="5" type="hidden"></div> --}}
                                @for($i = 1; $i <= 5; $i++ )
                                    @if ($i <= $point)
                                        <div class="star_{{$i}} ratings_stars ratings_hover"><input value="{{$i}}" type="hidden"></div>
                                    @else
                                        <div class="star_{{$i}} ratings_stars"><input value="{{$i}}" type="hidden"></div>
                                    @endif

                                @endfor
                                <span class="rate-np">{{$point}} </span>
                            </div>
                        </div>
                    </div>
                    <a href="">
                        <img src="{{ asset('upload/blog/image/'. $blog->image)}}" alt="" style="width:400px;height:500px;"/>
                    </a>
                    <div>
                        {!! $blog->description !!}
                    </div>

                    <div class="pager-area">
                        <ul class="pager pull-right">
                            <li><a href="{{ URL::to( 'blog_single/' . $blogprev ) }}">Pre</a></li>
                            <li><a href="{{ URL::to( 'blog_single/' . $blognext ) }}">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div><!--/blog-post-area-->

            <div class="rating-area">
                <ul class="ratings">
                    <li class="rate-this">Rate this item:</li>
                    <li>
                        <i class="fa fa-star color"></i>
                        <i class="fa fa-star color"></i>
                        <i class="fa fa-star color"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </li>
                    <li class="color">(6 votes)</li>
                </ul>
                <ul class="tag">
                    <li>TAG:</li>
                    <li><a class="color" href="">Pink <span>/</span></a></li>
                    <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                    <li><a class="color" href="">Girls</a></li>
                </ul>
            </div><!--/rating-area-->

            <div class="socials-share">
                <a href=""><img src="images/blog/socials.png" alt=""></a>
            </div><!--/socials-share-->

            <div class="media commnets">
                <a class="pull-left" href="#">
                    <img class="media-object" src="images/blog/man-one.jpg" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Annie Davis</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <div class="blog-socials">
                        <ul>
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                        <a class="btn btn-primary" href="">Other Posts</a>
                    </div>
                </div>
            </div><!--Comments-->
            <div class="response-area">
                <h2>{{count($comment)}} RESPONSES</h2>
                <ul class="media-list">
                    @foreach ($comment as $cm)
                        @if ($cm->level == 0)
                        <li class="media">

                            <a class="pull-left" href="#">
                                <img class="media-object" src="images/blog/man-two.jpg" alt="">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <p>{{$cm->content}} </p>
                                <a id="{{$cm->id}}" class="btn btn-primary btn-reply" ><i class="fa fa-reply"></i>Replay</a>

                            </div>
                        </li>
                        @endif



                    @foreach ($comment as $cmt)
                        @if ($cmt->level == $cm->id && $cmt->level != 0)
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="images/blog/man-three.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <p>{{$cmt->content}} </p>
                                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                        @endif

                    @endforeach

                    @endforeach



                </ul>
            </div><!--/Response-area-->
            <div class="replay-box">

                <div class="row">
                    <div class="col-sm-4">
                        <h2>Leave a replay</h2>
                            <div class="blank-arrow">
                                <label>Your Name</label>
                            </div>
                            <span>*</span>
                            <input type="text" placeholder="write your name...">
                    </div>
                    <div class="col-sm-8">
                        <div class="text-area">
                            <div class="blank-arrow">
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
                            <form action="commentblog" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="idblog" value="{{$blog->id}} ">
                                <input type="hidden" name="level" value="0" id="level-form">
                                <textarea name="content" rows="11"></textarea>
                                <button class="btn btn-primary" type="submit">post comment</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div><!--/Repaly Box-->
        </div>
    </div>
</div>
<script>

$(document).ready(function(){
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote');
            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        $('.ratings_stars').click(function(){
            var Values =  $(this).find("input").val();
            var idBlog = document.getElementById("idblog").value;
           // let _token   = $('meta[name="csrf-token"]').attr('content');
         //   alert(Values);


            if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).prevAll().andSelf().addClass('ratings_over');
            } else {
                $(this).prevAll().andSelf().addClass('ratings_over');
            }

            $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/rateblog",
                    type:"POST",
                    data:{
                        idblog:idBlog,
                        point:Values,
                    },
                    success:function(response){
                        console.log(response);
                        $('.rate-np').html(response);
                    },
                });
        });

        $('.btn-reply').click(function(){
            let level = $(this).attr('id');
            //console.log(level);
            $('#level-form').val(level);
        });
    });
</script>
@endsection
