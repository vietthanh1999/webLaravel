<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Blog;
use App\Rate;
use App\User;
use App\Comment;
class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // if(Auth::check()){
        //     view()->share('nguoidung', Auth::user());
        // }
    }
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

    public function blog(){
        $blog = Blog::paginate(3);

        return view('frontend.pages.blog', compact('blog'));
    }
    public function blog_single($id){
        $blog = Blog::find($id);

        $blogprev = Blog::where('id', '<', $blog->id)->max('id');

        $blognext = Blog::where('id', '>', $blog->id)->min('id');

        $rateAll = Rate::all();
       // dd($rateAll);
        $sumPoint = 0;
        $dem = 0;
        foreach($rateAll as $ra){
            if($ra->idblog == $id){
                $sumPoint += $ra->point;
                $dem++;
            }

        }
       // dd($sumPoint);
        $point = 0;

        if($dem != 0){
            $point = $sumPoint / $dem;
            $point = round($point);
          //  dd($point);
        }


        $commentAll = Comment::all();
        $comment = [];
        foreach($commentAll as $cmt){
            if($cmt->idblog == $id)
                $comment[] = $cmt;
        }

        return view('frontend.pages.blog_single', compact('blog','blogprev','blognext','point', 'comment' ));
    }
    public function rateblog(Request $request){
      //  $user = Auth::user();

        $rate = new Rate;
        $rate->iduser = Auth::id();
        $rate->idblog = $request->idblog;
        $rate->point = $request->point;

        $rateAll = Rate::all();

        $check = true;
        foreach($rateAll as $ra){
           if( $ra->iduser ==  $rate->iduser && $ra->idblog == $rate->idblog) {
                $check = false;
                $idRateBlog = $ra->id;
                break;
           }
        }

        if($check){
            $rate->save();
        }
        else {
            $rateUpdate = Rate::find($idRateBlog);
            $rateUpdate->point = $request->point;
            $rateUpdate->update();
        }
    }

    public function commentblog(Request $request){
        $user = Auth::user();
        $comment = new Comment;
        $comment->iduser = $user->id;
        $comment->avatar = $user->avatar;
        $comment->username = $user->name;
        $comment->idblog = $request->idblog;
        $comment->content = $request->content;
        $comment->level = $request->level;

       // dd($comment);

        $comment->save();

       // dd($resultcomment);
       return redirect('blog_single/' . $request->idblog)->with('thongbao','Bạn đã bình luận thành công thành công');
    }
}
