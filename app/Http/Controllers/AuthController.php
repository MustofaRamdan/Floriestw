<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    function landing(){
        return view('landing');
    }
    function daftar(){

        return view('auth.daftar');
    }

    function registrasi(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|min:6',
            'role'=> 'user'
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->save();
        return redirect()->route('masuk');
    }

    function masuk(){
        return view('auth.masuk');
    }

    function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',

        ]);


        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin'){
                return redirect()->route('admin.home');
            }
            elseif(Auth::user()->role === 'user'){
                return redirect()->route('user.home');
            }

        }
        else{
            return redirect()->back()->with('gagal', 'Email atau password salah');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login'); // Redirect ke halaman home atau login
    }


}
