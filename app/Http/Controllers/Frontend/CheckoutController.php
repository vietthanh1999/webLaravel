<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Mail;
use App\History;
use App\User;
class CheckoutController extends Controller
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
        return view('frontend.checkout.checkout',compact('product','sumMoney'));
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

    public function checkoutmail(){
        $product = array();
        if(\Session::get('cart')){
            $product = \Session::get('cart');
        }
        $sumMoney = 0;
        foreach($product as $value){
            $sumMoney += $value->price * $value->qty;
        }
        return view('frontend.email.sendmail',compact('product','sumMoney'));
    }


    public function sendMailOrder(){
        if(Auth::check()){
            $user = Auth::user();
        }

        return redirect('/');
    }

    public function checkoutRegister(Request $request){

        $user = new User;
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->save();
        //templateSendMail($user);

        $email = $user->email;
        //dd($email);
         $product = array();
        if(\Session::get('cart')){
            $product = \Session::get('cart');
        }
        $sumMoney = 0;
        foreach($product as $value){
            $sumMoney += $value->price * $value->qty;
        }
        Mail::send('frontend.email.sendmail', array(
            'product' => $product,
            'sumMoney' => $sumMoney,
        ), function($message) use ($email){
            $message->to($email, 'E-shopper')->subject('Đơn đặt hàng');
        });

        $history = new History;
        $history->email = $email;
        $history->phone = $user->phone;
        $history->name = $user->name;
        $history->id_user = $user->id;
        $history->price = $sumMoney;

        $history->save();

        return redirect('/');
    }

    public function templateSendMail(User $user){

    }
}
