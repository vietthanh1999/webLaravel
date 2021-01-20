<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use DB;
use App\Category;
use App\Brand;
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::take(5)->orderBy('created_at', 'desc')->paginate();
        return view('frontend.search.search',compact('product'));
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
    public function search(Request $request){
        $keywork = $request->keywork;

        $product = Product::where('name', 'like', "%$keywork%")->take(10)->paginate(3);

        return view('frontend.search.search',compact('product'));
    }
    public function getSearchAdvanced(){
        $category = Category::all();
        $brand = Brand::all();
        $product = Product::take(5)->orderBy('created_at', 'desc')->paginate();
        return view('frontend.search.searchadvanced',compact('product','category','brand'));
    }

    public function postSearchAdvanced(Request $request){
        $keywork = $request->keywork;
        $price = $request->price;
        $category = $request->category;
        $brand = $request->brand;
        $status = $request->status;

        $product = Product::query();
      //  dd($product);
        if($keywork) {
            $product->where('name', 'like', "%$keywork%");
        }
        if($price) {
            $product->whereBetween('price', [$price, ($price + 1) * 100]);
        }
        if($category) {
            $product->where('category', $category);
        }
        if($brand){
            $product->where('brand', $brand);
        }
        if($status){
            if($status == 0){
                $product->where('sale', '=', 0);
            }   else {
                $product->where('sale', '>=', 0);
            }
        }

        $product  = $product->get();
        // dd($product);
        $category = Category::all();
        $brand = Brand::all();
        return view('frontend.search.searchadvanced',compact('product','category','brand'));
    }

}
