<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Sportswear
                        </a>
                    </h4>
                </div>
                <div id="sportswear" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="">Nike </a></li>
                            <li><a href="">Under Armour </a></li>
                            <li><a href="">Adidas </a></li>
                            <li><a href="">Puma</a></li>
                            <li><a href="">ASICS </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Mens
                        </a>
                    </h4>
                </div>
                <div id="mens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="">Fendi</a></li>
                            <li><a href="">Guess</a></li>
                            <li><a href="">Valentino</a></li>
                            <li><a href="">Dior</a></li>
                            <li><a href="">Versace</a></li>
                            <li><a href="">Armani</a></li>
                            <li><a href="">Prada</a></li>
                            <li><a href="">Dolce and Gabbana</a></li>
                            <li><a href="">Chanel</a></li>
                            <li><a href="">Gucci</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Womens
                        </a>
                    </h4>
                </div>
                <div id="womens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="">Fendi</a></li>
                            <li><a href="">Guess</a></li>
                            <li><a href="">Valentino</a></li>
                            <li><a href="">Dior</a></li>
                            <li><a href="">Versace</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Kids</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Fashion</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Households</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Interiors</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Clothing</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Bags</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Shoes</a></h4>
                </div>
            </div>
        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
                    <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                    <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
                    <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
                    <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
                    <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
                    <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well">
                 <input type="text"  class="span2 slider" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b>$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->

        <div class="shipping text-center"><!--shipping-->
            <img src="images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.slider').on('slide', function (ev) {
            var getID = $(this).val();

           console.log("hello", getID);
           if(getID){
            $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/ajaxpricerange",
                    type:"POST",
                    data:{
                        id: getID
                    },
                    success:function(response){
                        //  console.log(Object.entries(response));
                        //  $('#numcart').html(Object.entries(response).length);
                        let arrayProduct = JSON.parse(response);
                        var html = "";
                        var temp = "";
                        arrayProduct.map(function(value, key){
                            var temp = "";
                            temp =  ' <div class="col-sm-4">' +
                                    '<div class="product-image-wrapper">' +
                                        '<div class="single-products">' +
                                            '<div class="productinfo text-center">' +
                                                ' <img src="{{URL::asset("upload/product/folderiduser/200x300imagename"  )}}" alt="" />' +
                                                '<h2>' + value['price'] + '</h2>' +
                                                '<p>' +  value['name'] + '</p>' +
                                                '<a  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
                                            '</div>' +
                                            '<div class="product-overlay">' +
                                                '<div class="overlay-content">' +
                                                    '<h2>' + value['price'] + '</h2>' +
                                                    '<p>' + value['name'] + '</p>' +
                                                    '<a id="' + value['id']+ '" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="choose">' +
                                            '<ul class="nav nav-pills nav-justified">' +
                                                '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>' +
                                                '<li><a href="{{URL::asset("productdetail/idproduct")}}"><i class="fa fa-plus-square"></i>Product Detail</a></li>' +
                                            '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>';
                                // ' + value->iduser + '/3' + JSON.parse(value->image)[0] + '
                                let iduser = value['iduser'];
                                let imagename = JSON.parse(value['image'])[0];
                                let idproduct = value['id'];
                                temp = temp.replace('folderiduser', iduser );
                                temp = temp.replace('imagename', imagename );
                                temp = temp.replace('idproduct', idproduct );

                                html += temp;
                        });

                       // console.log(html);
                        $('.features_items').html(html);


                    },
                });
           }
        });
    });
    </script>
