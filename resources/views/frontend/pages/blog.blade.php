@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-sm-9">
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From our Blog</h2>
                @foreach ($blog as $bl)
                    <div class="single-blog-post">
                        <h3>{{$bl->title}} </h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Mac Doe</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                            </span>
                        </div>
                        <a href="">
                            <img src="upload/blog/image/{{$bl->image}}" alt=""  style="width:300px;height:400px;">
                        </a>

                        {!! $bl->content !!}
                        <br/>

                        <a  class="btn btn-primary" href="{{ URL::asset('blog_single/' .$bl->id)}}">Read More</a>
                    </div>

                @endforeach
                <br/>
                {!! $blog->links() !!}



                {{-- <div class="pagination-area">
                    <ul class="pagination">
                        <li><a href="" class="active">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
