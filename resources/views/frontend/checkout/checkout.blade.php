@extends('layouts.notleft-sidebar')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            @if (!Auth::check())
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

                            @if(session('thongbaoregister'))
                                <div class="alert alert-success">
                                    {{session('thongbaoregister')}}
                                </div>
                            @endif
                            <form action="{{URL::asset('checkoutregister')}}" method="post">
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
            @endif

        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
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
                    @foreach ($product as $item)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::asset('upload/product/'. $item->iduser .'/50x70'. json_decode($item->image)[0])}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->name}}</a></h4>
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
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td class="item-cart-sub-total">{{$sumMoney}}</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>{{$sumMoney}}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
        </div>
        @if (Auth::check())
            <a class="btn btn-primary" href="{{URL::asset('sendmailorder')}}">Order</a>
        @endif

    </div>

</section> <!--/#cart_items-->

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
