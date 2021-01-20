<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();
        return view('admin.blog.index',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBlogRequest $request)
    {
        //
        $blog = new Blog;
        $blog->title = $request->title;
        $file = $request->image;
        if(!empty($file)){
            $blog->image = $file->getClientOriginalName();
        }
        $blog->description = $request->description;
        $blog->content = $request->content;
        $blog->save();

        if ($blog->save()) {
            if(!empty($file)){
                $file->move('upload/blog/image', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }

       // return redirect('blog/add')->with('thongbao','Thêm thành công');

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
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        //
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $file = $request->image;
        if(!empty($file)){
            $blog->image = $file->getClientOriginalName();
        }
        $blog->description = $request->description;
        $blog->content = $request->content;
        if ($blog->update()) {
            if(!empty($file)){
                $file->move('upload/blog/image/', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
       // $country->save();
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
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('admin/blog')->with('thongbao','Bạn đã xóa thành công');
    }
}
