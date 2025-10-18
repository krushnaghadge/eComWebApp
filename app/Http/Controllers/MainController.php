<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
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

        // dd($allProduct);

        $allProduct = Product::all();
        $newArrival = Product::where('type', 'new-arrivals')->get();
        $hotSale = Product::where('type', 'hot-sales')->get();
        // return view('dashbord');

        return view('dashboard', compact('allProduct', 'newArrival', 'hotSale'));
    }


    public function cart()
    {
        $cartItems = DB::table('products')
            ->join('carts', 'carts.productId', '=', 'products.id')
            ->select('products.title', 'products.quantity as pQuantity', 'products.price', 'products.picture', 'carts.*')
            ->where('carts.customerId', session()->get('id'))
            ->get();

        return view('cart', compact('cartItems'));
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

            return redirect('/');

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

    public function deleteCartItem($id)
    {

        $item = Cart::find($id);
        $item->delete();
        return redirect()->back()->with('sucess', '1 Itema cart delete sucessfully');
    }


    public function updateCart(Request $data)
    {
        if (session()->has('id')) {
            $item = Cart::find($data->input('id'));

            $item->quantity = $data->input('quantity');

            $item->save();

            return redirect()->back()->with('success', 'Item quantity updated successfully.');
        } else {
            return redirect()->back()->with('alert', 'You must be logged in to update items to your cart.');
        }
    }


    public function checkout(Request $data)
    {
        if (session()->has('id')) {

            $order = new Order();
            $order->status = "pending";
            $order->customerId = session('id');


            $order->bill = $data->input('bill');
            $order->adress = $data->input('address');
            $order->fullname = $data->input('fullname');
            $order->phone = $data->input('phone');

            if ($order->save()) {
                $carts = Cart::where('customerId', session()->get('id'))->get();
                foreach ($carts as $item) {
                    $product = Product::find($item->productId);
                    $orderItem = new OrderItem();

                    $orderItem->productId = $item->productId;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->price = $product->price;
                    $orderItem->orderId = $order->id;
                    $orderItem->save();
                    $item->delete();
                }
            };

            return redirect()->back()->with('success', 'your order successfully placed.');
        } else {
            return redirect()->back()->with('alert', 'You must be logged in to update items to your cart.');
        }
    }


    public function myOrders()
    {
        if (session()->has('id')) {
            $orders = Order::where('customerId', session()->get('id'))->get();

            $items = DB::table('products')
                ->join('order_items', 'order_items.productId', '=', 'products.id')
                ->select('products.title', 'products.picture', 'order_items.*')
                ->get();

            return view('order', compact('orders', 'items'));
        }

        return redirect('login');
    }
}
