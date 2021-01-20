@extends('layouts.notleft-sidebar')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($product as $key => $item)

                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::asset('upload/product/'. $item->iduser .'/50x70'. json_decode($item->image)[0])}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->name}} </a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <span class="item_price">{{$item->price}}</span>VND
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a id="{{$item->id}} " class="cart_quantity_up" > + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}} " autocomplete="off" size="2">
                                <a id="{{$item->id}} " class="cart_quantity_down" > - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$item->qty * $item->price}} </p>
                        </td>
                        <td class="cart_delete">
                            <a id="{{$item->id}} " class="cart_quantity_delete" ><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li >Cart Sub Total <span class="item-cart-sub-total">{{$sumMoney}} </span></li>
                        <li>Eco Tax <span class="item-eco-taxt">0</span>VND</li>
                        <li>Shipping Cost <span class="item-shipping-cost" value="">0</span>VND</li>
                        <li >Total <span class="all-total">{{$sumMoney}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{URL::asset('checkout')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
<script>
	$(document).ready(function () {
		$(".cart_quantity_delete").click(function(){
			var getID = $(this).attr('id');
            console.log(getID);
			// var row = "#row" + getID;
			// $(row).hide();
            $(this).closest('tr').hide();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxcartdeleteproduct",
                type:"POST",
                data:{
                    id: getID
                },
                success:function(response){
                     console.log(Object.entries(response));
                },
            });
            $('.cart_total_price').trigger("change");
		});

        $(".cart_quantity_up").click(function(){

			var getID = $(this).attr('id');
			var getQTY = $(this).next().val();
			var getTotal = $(this).closest('tr').find('.cart_total_price').text();
			var getPrice = 	$(this).closest('tr').find('.item_price').text();
			$(this).next().val(Number(getQTY) + 1);
           // console.log(getPrice);
			$(this).closest('tr').find('.cart_total_price').text((Number(getQTY) + 1) * Number(getPrice));
			//var row = "#cart_quantity_input" + getID;
			//var value = $(row).attr('value');

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxcart_quantity_up",
                type:"POST",
                data:{
                    id: getID
                },
                success:function(response){
                    // console.log(Object.entries(response));
                },
            });
            $('.cart_total_price').trigger("change");
		});


        $(".cart_quantity_down").click(function(){
			// $('.cart_total_price').bind("change");

			var getID = $(this).attr('id');
			var getQTY = $(this).prev().val();
			var getTotal = $(this).closest('tr').find('.cart_total_price').text();
			var getPrice = 	$(this).closest('tr').find('.item_price').text();

			$(this).closest('tr').find('.cart_total_price').text((Number(getQTY) - 1) * Number(getPrice));
			if(getQTY > 1) {
				$(this).prev().val(Number(getQTY) - 1);
			}
			else {
				//alert(111)
				$(this).closest("tr").remove();
			}
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxcart_quantity_down",
                type:"POST",
                data:{
                    id: getID
                },
                success:function(response){
                    // console.log(Object.entries(response));
                },
            });
            $('.cart_total_price').trigger("change");
		});

        $('.cart_total_price').change(function(){
			var getShippingCost = $('.item-shipping-cost').text();
			console.log(getShippingCost);
			//alert(111)
			$.ajax({
				method: "POST",
				url: "/ajaxcart_total_price",
				data: {
					change: 1
				},
				success : function(response){
					console.log(response);
					$(".item-cart-sub-total").text(response);

					$(".all-total").text(Number(response) + Number(getShippingCost));
				}
			});

		});
	});
</script>
@endsection
