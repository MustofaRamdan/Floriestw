<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bunga;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function home(){
        $totalpendapatan = Pembeli::sum('total_harga');
        $pembelis = Pembeli::with('bunga')->paginate(10);
        $totalbunga = Bunga::sum('stock');
        $totaluser = User::count();
        $bunga = Bunga::paginate(5);
        $user = User::paginate(5);
        return  view('admin.home', compact('user', 'totaluser', 'bunga', 'totalbunga', 'pembelis', 'totalpendapatan'));
    }

    function tambah_user(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|min:6',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('admin.home');
    }

    function editUser($id){
        $user = User::find($id);
        return view ('admin.edit', compact('user'));
    }

    function edit_user(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|max:255',
            'password' => 'required|min:6'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        $user->update();

        return redirect()->route('admin.home');


    }

    function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }


    function tambahBunga(Request $request){
        $bunga =new Bunga;
        $bunga->nama = $request->nama;
        $bunga->harga = $request->harga;
        if($request->hasFile('image')){
            $imagename = time() .'.'. $request->image->extension();
            $request->image->move(public_path('image/database'), $imagename);
            $bunga->image = $imagename;
        }
        $bunga->stock = $request->stock;
        $bunga->save();

        return redirect()->back();
    }

    function editBunga($id){
        $bunga = Bunga::find($id);
        return view('admin.edit_bunga', compact('bunga'));
    }

    function updateBunga(Request $request, $id){
        $bunga = Bunga::find($id);
        $bunga->nama = $request->nama;
        $bunga->harga = $request->harga;
        if($request->hasFile('image')){
            $imagename = time() .'.'. $request->image->extension();
            $request->image->move(public_path('image'), $imagename);
            $bunga->image = $imagename;
        }
        $bunga->stock = $request->stock;
        $bunga->update();

        return redirect()->route('admin.home');
    }

    function deleteBunga($id){
        $bunga = Bunga::find($id);
        $bunga->delete();

        return redirect()->route('admin.home');
    }
}
