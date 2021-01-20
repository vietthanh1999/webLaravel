<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\Http\Requests\CreateCountryRequest;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $country = Country::all();
        return view('admin.country.country',['country'=>$country]);
    }
    public function addcountry()
    {
        //
       // $country = Country::find($id);

        return view('admin.country.addcountry');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateCountryRequest $request)
    {
        //
        $country = new Country;
        $country->name = $request->name;
        $country->save();

        return redirect('country/add')->with('thongbao','Thêm thành công');
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
        $country = Country::find($id);
        return view('admin.country.editcountry', ['country'=>$country]);
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
        // $this->validate($request,
        // [
        //     'name' => 'required,name|min:3|max:100',

        // ],
        // [
        //     'name.required' => 'Bạn chưa nhập tên loại tin',
        //     'name.min'=>'Tên loại tin phải có độ dài từ 3 đến 100 ký tự',
        //     'name.max'=>'Tên loại tin phải có độ dài từ 3 đến 100 ký tự',

        // ]);
        $country = Country::find($id);
        $country->name = $request->name;
        $country->save();

        return redirect('admin/country/edit/'.$id)->with('thongbao','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect('admin/country')->with('thongbao','Bạn đã xóa thành công');
    }
}
