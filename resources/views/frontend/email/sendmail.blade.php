<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #customers {
          font-family: "Times New Roman",Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers thead, #title-td {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #4CAF50;
          color: white;
        }
        </style>
</head>

<body>

    <section id="cart_items">
        <div class="container">


            <div class="table-responsive cart_info">
                <table class="table table-condensed" id="customers">
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
                                <a href=""><img src="{{URL::asset('upload/product/'. $item->iduser .'/2'. json_decode($item->image)[0])}}" alt=""></a>
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
                                        <td id="title-td">Cart Sub Total</td>
                                        <td class="item-cart-sub-total">{{$sumMoney}}</td>
                                    </tr >
                                    <tr>
                                        <td id="title-td">Exo Tax</td>
                                        <td>$</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td id="title-td">Shipping Cost</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td id="title-td">Total</td>
                                        <td><span>{{$sumMoney}}</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
    </section> <!--/#cart_items-->
</body>

</html>
