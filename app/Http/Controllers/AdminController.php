<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{



    public function index()
    {
        if (session()->get('type') != 'admin') {
            // return redirect('/login');
            return view('dashboard.index');
        }

        return redirect()->back();
    }


    public function profile()
    {
         if (session()->get('type') != 'admin') {
            $user = User::find(session()->get('id'));
            return view('dashboard.profile', compact('user'));
        }

        return redirect('/login');
    }




    public function products()
    {
        if (session()->get('type') != 'admin') {
            $products = Product::All();
            return view('dashboard.products', compact('products'));
        }
        return redirect()->back();
    }

    public function deleteProduct($id)
    {
        if (session()->get('type') != 'admin') {
            $product = Product::find($id);
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully.');
        }
        return redirect()->back();
    }

    public function addNewProduct(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'type' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->type = $request->type;
        $product->picture = $imageName;
        $product->save();

        return redirect()->back()->with('success', 'Product added successfully.');
    }


    public function UpdateProduct(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'type' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->type = $request->type;

        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
            $product->picture = $imageName;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully.');
    }
}
