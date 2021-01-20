<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = array();
        if(\Session::get('cart')){
            $product = \Session::get('cart');
        }
        $sumMoney = 0;
        foreach($product as $value){
            $sumMoney += $value->price * $value->qty;
        }
        return view('frontend.cart.cart',compact('product','sumMoney'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxcart(Request $request){
        $idProduct = $request->id;
      //  $request->session()->flush();
        $check = true;
        if(\Session::get('cart')){
            foreach(\Session::get('cart') as $key => $item){
                if($idProduct == $key){
                    \Session::get('cart')[$key]->qty += 1;
                    $check = false;
                }
            }
        }

        if($check){
            $productFind = Product::find($idProduct);
            $product = new Product;
            $product->id = $productFind->id;
            $product->name = $productFind->name;
            $product->image = $productFind->image;
            $product->price = $productFind->price;
            $product->iduser = $productFind->iduser;
            $product->qty = 1;
            $arrayProduct = array();
            if(\Session::get('cart'))
                $arrayProduct = \Session::get('cart');
            $arrayProduct[$idProduct] = $product;

            \Session::put('cart',$arrayProduct);
        }

        //return json_encode(\Session::get('cart'));
        return \Session::get('cart');
    }

    public function deleteproduct(Request $request){
        $idProduct = $request->id;

        $check = true;
        $arrayProduct = array();
        if(\Session::get('cart')){
            $arrayProduct = \Session::get('cart');
           // dd($arrayProduct);
            foreach($arrayProduct as $key => $item){
                if($key == $idProduct){
                  //  $arrayProduct[$key]->qty = 0;
                    unset($arrayProduct[$key]);
                }
            }

            \Session::put('cart',$arrayProduct);
        }

        //return json_encode(\Session::get('cart'));
        //return \Session::get('cart');
    }


    public function quantityUp(Request $request){
        $idProduct = $request->id;

        $check = true;
        $arrayProduct = array();
        if(\Session::get('cart')){
            $arrayProduct = \Session::get('cart');
           // dd($arrayProduct);
            foreach($arrayProduct as $key => $item){
                if($key == $idProduct){
                    $arrayProduct[$key]->qty += 1;
                }
            }

            \Session::put('cart',$arrayProduct);
        }

        //return json_encode(\Session::get('cart'));
        //return \Session::get('cart');
    }
    public function quantityDown(Request $request){
        $idProduct = $request->id;

        $check = true;
        $arrayProduct = array();
        if(\Session::get('cart')){
            $arrayProduct = \Session::get('cart');
           // dd($arrayProduct);
            foreach($arrayProduct as $key => $item){
                if($key == $idProduct){
                    if($arrayProduct[$key]->qty <= 1){
                        $arrayProduct[$key]->qty = 0;
                        unset($arrayProduct[$key]);

                    } else
                    $arrayProduct[$key]->qty -= 1;
                }

            }

            \Session::put('cart',$arrayProduct);
        }

        //return json_encode(\Session::get('cart'));
        //return \Session::get('cart');
    }
    public function totalPrice(Request $request){
        $idProduct = $request->id;
        $arrayProduct = array();
        $sumMoney = 0;
        if(\Session::get('cart')){
            $arrayProduct = \Session::get('cart');
            // dd($arrayProduct);

            foreach($arrayProduct as $key => $item){
                $sumMoney += $item->price * $item->qty;
            }
        }
        return $sumMoney;
        //return json_encode(\Session::get('cart'));
        //return \Session::get('cart');
    }

    public function addToCartFromProductDetail(Request $request){
        $idProduct = $request->id;
        $qty = $request->qty;

        $check = true;
        if(\Session::get('cart')){
            foreach(\Session::get('cart') as $key => $item){
                if($idProduct == $key){
                    \Session::get('cart')[$key]->qty += $qty;
                    $check = false;
                }
            }
        }

        if($check){
            $productFind = Product::find($idProduct);
            $product = new Product;
            $product->id = $productFind->id;
            $product->name = $productFind->name;
            $product->image = $productFind->image;
            $product->price = $productFind->price;
            $product->iduser = $productFind->iduser;
            $product->qty = $qty;
            $arrayProduct = array();
            if(\Session::get('cart'))
                $arrayProduct = \Session::get('cart');
            $arrayProduct[$idProduct] = $product;

            \Session::put('cart',$arrayProduct);
        }

        //return json_encode(\Session::get('cart'));
        return redirect('/cart');
    }

}
