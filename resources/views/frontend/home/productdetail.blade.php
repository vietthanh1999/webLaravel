@extends('layouts.custom')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img class="image-active" src="{{URL::asset('upload/product/'. $product->iduser .'/200x300'. json_decode($product->image)[0])}}" alt="" />
                            <a class="image-zoom" href="{{URL::asset('upload/product/'. $product->iduser .'/'. json_decode($product->image)[0])}}" rel="prettyPhoto"><h3>ZOOM</h3></a>

                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                              <!-- Wrapper for slides -->

                                <div class="carousel-inner">
                                    <div class="item active">
                                        @foreach (json_decode($product->image) as $item)
                                            <a ><img class="image-slide" src="{{URL::asset('upload/product/'. $product->iduser .'/50x70'. $item)}}" alt=""></a>
                                        @endforeach
                                    </div>
                                    <div class="item">
                                        @foreach (json_decode($product->image) as $item)
                                            <a><img class="image-slide" src="{{URL::asset('upload/product/'. $product->iduser .'/50x70'. $item)}}" alt=""></a>
                                        @endforeach
                                    </div>


                                </div>



                              <!-- Controls -->
                              <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{$product->name}} </h2>
                            <p>Web ID: 1089772</p>
                            <img src="{{URL::asset('images/product-details/rating.png')}}" alt="" />
                            <span>
                                <span>{{$product->price}} VND</span>
                                <form action="{{URL::asset('addtocartfromdetailproduct')}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="id" value="{{$product->id}} ">
                                    <label>Quantity:</label>
                                    <input name="qty" type="text" value="1" />
                                    <button type="submit" type="button" class="btn btn-fefault cart btn-add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </form>

                            </span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b>
                                @if ($product->sale == 0)
                                New
                                @else
                                Sale {{$product->sale}}
                                @endif </p>
                            <p><b>Brand:</b>{{$product->brand}} </p>
                            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Details</a></li>
                            <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                            <li><a href="#tag" data-toggle="tab">Tag</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">


                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Your Name"/>
                                        <input type="email" placeholder="Email Address"/>
                                    </span>
                                    <textarea name="" ></textarea>
                                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->


            </div>
        </div>
    </div>
</section>
<script src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto();
    });
</script>
<script>
$( document ).ready(function() {
    $( ".image-slide" ).click(function() {
        let src = $(this).attr('src');
        let arrayNameProduct = src.split("/");
        let nameProduct = arrayNameProduct.pop();
        var newName = nameProduct.replace("50x70", "200x300");
        arrayNameProduct.push(newName);
        src = arrayNameProduct.join("/");
        //console.log(src);
        $(".image-active").attr('src', src);
        $(".image-zoom").attr('href', src);
    });

    $('.btn-add-to-cart').click(function(){
        var getID = $(this).attr('id');
        var getQty = $(this).prev().val();
        console.log(getID);
        console.log(getQty);
            // $.ajaxSetup({
            //         headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            // $.ajax({
            //     url: "/ajaxcart",
            //     type:"POST",
            //     data:{
            //         id: getID
            //     },
            //     success:function(response){
            //          console.log(Object.entries(response));
            //          $('#numcart').html(Object.entries(response).length);
            //     },
            // });
    });
});

</script>
@endsection
