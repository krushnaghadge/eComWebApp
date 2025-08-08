<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //


    public function index()
    {
        $allProduct = Product::all();
        dd($allProduct);
        return view('index');
    }


   public function cart()
{
    $cartItems = DB::table('products')
        ->join('carts', 'carts.productId', '=', 'products.id')
        ->select('products.title', 'products.quantity as pQuantity','products.price', 'products.picture', 'carts.*')
        ->where('carts.customerId', session()->get('id'))
        ->get();

    return view('cart', compact('cartItems'));
}


    public function checkout()
    {
        return view('checkout');
    }

    public function shop()
    {
        return view('shop');
    }

    public function singleProduct($id)
    {

        $product = Product::find($id);

        return view('single', compact('product'));
    }



    public function register()
    {
        return view('register');
    }

    public function registerUser(Request $data)
    {
        $newUser = new User();
        $newUser->fullname = $data->input('fullname');
        $newUser->email = $data->input('email');
        $newUser->password = $data->input('password'); // Plaintext (Not secure)

        $file = $data->file('file');
        $newUser->picture = $file->getClientOriginalName();
        $file->move('uploads/profiles/', $newUser->picture);

        $newUser->type = "Customer";

        if ($newUser->save()) {
            return view('login')->with('success', 'Your account is created. Please login.');
        }

        return redirect()->back()->with('error', 'Registration failed. Try again.');
    }





    public function login()
    {
        return view('singleProduct');
    }
    public function logout()
    {
        session()->flush(); // Clear all session data
        return redirect('/login')->with('success', 'Logged out successfully.');
    }












    public function showLogin()
    {
        return view('login'); // contains form with action="/loginUser"
    }

    public function loginUser(Request $request)
    {
        $user = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->first();

        if ($user) {
            session()->put('id', $user->id);
            session()->put('type', $user->type);

            return redirect('/dashboard');

            //  return redirect('/');

        }

        return redirect('/login')->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        if (!session()->has('id')) {
            return redirect('/login')->with('error', 'Please log in first.');
        }


        $allProduct = Product::all();
        $newArrival = Product::where('type', 'new-arrivals')->get();
        $hotSale = Product::where('type', 'hot-sales')->get();
        // dd($allProduct);

        return view('dashboard', compact('allProduct', 'newArrival', 'hotSale'));
    }

public function addToCart(Request $request)
{
    if (session()->has('id')) {
        $item = new Cart();

        $item->quantity = $request->input('quantity');
        $item->productId = $request->input('id');
        $item->customerId = session('id'); // Corrected way to retrieve session data

        $item->save();

        return redirect()->back()->with('success', 'Item added to cart successfully.');
    } else {
        return redirect()->back()->with('alert', 'You must be logged in to add items to your cart.');
    }
}

public function deleteCartItem ($id){

     $item=Cart::find($id);
     $item->delete();
     return redirect()->back()->with('sucess','1 Itema cart delete sucessfully');
}





}
