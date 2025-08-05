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


}
