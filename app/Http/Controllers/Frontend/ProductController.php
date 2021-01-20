<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Requests\AddProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;
use Image;
use App\Category;
use App\Brand;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $iduser = Auth::id();
        $product = Product::find($id);
        return view('frontend.product.editproduct', compact('product', 'iduser'));

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
        $iduser = Auth::id();
        $product = Product::find($id);
        //dd($product);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->sale = $request->sale;

        foreach(json_decode($product->image) as $img ){
            $data[] = $img ;
        };

        if($request->checkbox){
            foreach($data as $key => $item){
                foreach($request->checkbox as $checked) {
                    if($item == $checked){
                        unset($data[$key]);
                        unlink('upload/product/' . $product->iduser . '/' . $item);
                    }
                }
            }
        }


     //   dd($data);
        if($request->hasfile('image'))
        {
            if(count($request->file('image')) + count($data) > 3){
                return redirect()->back()->withErrors('Khong duoc dang 1 san pham qua 3 anh.');
            }
            foreach($request->file('image') as $image)
            {

                $name = $image->getClientOriginalName();
                $name_2 = "2".$image->getClientOriginalName();
                $name_3 = "3".$image->getClientOriginalName();

                //$image->move('upload/product/', $name);

                $path = public_path('upload/product/'. $iduser . '/' . $name);
                $path2 = public_path('upload/product/'. $iduser . '/' . $name_2);
                $path3 = public_path('upload/product/'. $iduser . '/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);

                $data[] = $name;
            }
        }

        $product->image = json_encode($data);

        if ($product->update()) {
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
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
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('thongbao', 'Da xoa san pham thanh cong');
    }
    public function getmyproduct(){
        if(Auth::check())
            $iduser = Auth::id();
        $productList = Product::all();

        $products = [];
        foreach($productList as $item){
            if($item->iduser == $iduser){
                $products[] = $item;
            }
        }

        return view('frontend.product.myproduct', compact('products', 'iduser'));
    }
    public function getAddProduct(){
        $category = Category::all();
        $brand = Brand::all();
        return view('frontend.product.addproduct',compact('category','brand'));
    }
    public function postAddProduct(AddProductRequest $request){
        $product = new Product;
        $product->name = $request->name;
        $file = $request->image;
      //  dd($request->image);

        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->sale = $request->sale;

        if(Auth::check())
            $iduser = Auth::id();
        $product->iduser = $iduser;
       // dd($request->hasfile('image'));
        if($request->hasfile('image'))
        {

            foreach($request->file('image') as $image)
            {

                $name = $image->getClientOriginalName();
                $name_2 = "50x70".$image->getClientOriginalName();
                $name_3 = "200x300".$image->getClientOriginalName();

                //$image->move('upload/product/', $name);

                $path = public_path('upload/product/'. $iduser . '/' . $name);
                $path2 = public_path('upload/product/'. $iduser . '/' . $name_2);
                $path3 = public_path('upload/product/'. $iduser . '/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);

                $data[] = $name;
            }
        }

        $product->image=json_encode($data);

        $product->save();

        return back()->with('thongbao', 'Your procuct has been successfully');

     }

     public function ajaxPriceRange(Request $request){
         $value = $request->id;
        // dd($value);
        $price = explode(",", $value);
       // return $price;
        $product = Product::where('price', '>=' , $price[0] )
                    ->where('price', '<=' , ($price[1]))
                    ->get();

        // dd($product);
        $category = Category::all();
        $brand = Brand::all();
        return json_encode($product);
       // return view('frontend.search.searchadvanced',compact('product','category','brand'));
     }
}
