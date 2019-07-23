<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    //
    public function redirectProvider($social){
    	return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
    	$user =Socialite::driver($social)->user();
    	$authUser =$this ->findOrCreateUser($user);
    	Auth::login($authUser);
    	return redirect('/');
    }

    private function findOrCreateUser($user){
    	$authUser=User::where('social_id',$user->id)->first();
    	if($authUser){
    		return $authUser;
    	}else{
    		return User::create([
    			'name'=>$user->name,
    			'email'=>$user->email,
    			'password'=>'',
    			'rule'=>0,
                'social_id'=>$user->id,
    			'status'=>0,
    			'avatar'=>$user->avatar,



    		]);
    	}


    }

    public function logout(){
    	if(Auth::check()){
    		Auth::logout();
    		return redirect('/');
    	}
    }

    public function signup(Request $request){
    	$this->validate($request,
    		[
    			'name'=>'min:2|max:255',
    			'email'=>'email|unique:users,email',
    			'password1'=>'min:6|max:32',
    			'password2'=>'same:password1',



    		],
    		[
    			'name.min' => 'Tên tối thiểu 2 kí tự',
    			'name.max' => 'Tên tối đa 255 kí tự',
    			'email.email' => 'Định dạng email không hỗ trợ',
    			'email.unique' => 'Email đã được sử dụng',
    			'password1.min' => 'password tối thiểu 6 kí tự',
    			'password1.max' => 'password tối đa 32 kí tự',
    			'password2.same' => 'Mật khẩu chưa khớp',

    		]);
        $user = new User;
        $user->name =$request->name;
        $user->email =$request->email;
        $user->password = bcrypt($request->password1);
        $user ->status=1;
        $user->save();
        Auth::login($user);
        
        
       return back()->with('thongbao','Đăng kí thành công');
        
        
    }

    public function login(Request $request){
        $this->validate($request,
            [
               
                'email'=>'email',
            ],
            [
                
                'email.email' => 'Định dạng email không đúng',

            ]
        );
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
             return back()->with('thongbao','Đăng nhập thành công');
        }else {
             return back()->with('thongbao','Đăng nhập thất bại');
        }


    }
}
