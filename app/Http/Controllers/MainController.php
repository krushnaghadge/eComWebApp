<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //


public function index()
    {
        return view('index');
    }


    public function cart()
{
    return view('cart');
}

public function checkout()
{
    return view('checkout');
}

public function shop()
{
    return view('shop');
}

public function singleProduct()
{
    return view('singleProduct');
}



public function register()
{
  return view('register');
}

public function registerUser(Request $data) {
    $newUser = new User();
    $newUser->fullname=$data->input('fullname');
    $newUser->email=$data->input('email');
    $newUser->password=$data->input('password');
    $newUser->picture=$data->file('file')->getClientOriginalName();
    $data->file('file')->move('uploads/profiles/',$newUser->picture);
    $newUser->type="Customer";
    if($newUser->save())
    {
        return view('login')->with('sucess','ypur account is login');
    }
  
}

public function loginUser(Request $data)
{

    $user = User::where('email',$data->input('email'))->where('password',$data->input('password'))->first();
if($user){
    session()->put('id',$user->id);
    session()->put('type',$user->type);
    if($user->type=='Customer');

}
    // return view('singleProduct');
}


public function login()
{
    return view('singleProduct');
}
}
