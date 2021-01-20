<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\AddProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Frontend.users.login');
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

    public function login(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
       // dd($login);
        $remember = false;
        // dd(Auth::attempt($login, $remember));
        if (Auth::attempt($login, $remember)) {
            return redirect('/account')->with('thongbao','Bạn đã đăng nhập thành công');
        } else {
            return redirect()->back()->withErrors('Email or password is not correct.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/userlogin');
    }
    public function getRegister(){
        return view('frontend.users.register');
    }
    public function register(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->level = 0;
        $user->save();
        return redirect()->back()->with('thongbaoregister','Bạn đã đăng ký thành công');
    }

    public function getaccount(){
        $user = Auth::user();

      //  dd($user);
        return view('frontend.users.account', compact('user'));
    }

    public function postaccount(UpdateProfileRequest $request){
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password'] ) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }
       //dd($data);
        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }

}

