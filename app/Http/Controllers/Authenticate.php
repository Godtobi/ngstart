<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Authenticate extends Controller
{
    public function signIn(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|max:255'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $check=DB::table('users')->where('email',$request->email)->get()[0];

            if($check->email=='admin@gmail.com' || $check->role){
                return redirect('/users');
            }
            return redirect('/');
        }

        return redirect('/signin')->with('error','Invalid Email or Passsword');
    }

    public function validation($request){
        return $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users|max:225',
            'password'=>'required|confirmed|max:255',
            'phone'=>'required|unique:users|max:225'
        ]);
    }

    public function register(Request $request){
        $this->validation($request);
        $request['password']=bcrypt($request['password']);
        User::create($request->all());
        $check=DB::table('users')->where('email',$request->email)->get()[0];
        $user=$request->all();
//        unset($user['token']);
        auth()->login($user);
//        Auth::attempt($user);
        return redirect('/');
//        if(Auth::attempt($request->all()){
//            return redirect('/');
//        }
    }
}
