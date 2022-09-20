<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller;
use Carbon\Carbon;

class SellerController extends Controller
{
    public function Index(){
        return view('seller.seller_login');
    }

    public function SellerDashboard(){
        return view('seller.index');
    }

    public function SellerCheck(Request $request){

        $check = $request->all();
        if(Auth::guard('seller')->attempt(['email' => $check['email'], 'password' => $check['password']  ])){
            return redirect()->route('seller.dashboard')->with('error','Seller Login Successfully');
        }else{
            return back()->with('error','Invaild Email Or Password');
        }

    }

    public function SellerLogout(){
        Auth::guard('seller')->logout();
    }

    public function SellerRegister(){
        return view('seller.seller_register');
    }

    public function SellerRegisterStore(Request $request){
        //dd($request->all());

        Seller::insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'created_at' => Carbon::now()

        ]);

        return redirect()->route('login_form')->with('error','Registered Successfully');
    }

}
