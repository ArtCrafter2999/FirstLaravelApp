<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MainController extends Controller
{
    public function home()
    {
        $tab = 'home';
        $categories = Category::all();
        return view('home', compact('categories', 'tab'));
    }

    public function productsByCategory(int $categoryId)
    {
        $tab = 'home';
        $products = Product::all()->where("category_id", "=", $categoryId)->get();
        return view('home', compact('', 'products', 'tab'));
    }

    public function hotels()
    {
        $tab = 'hotels';
        $hotels = [
            ['name' => 'dfgdfg', 'star' => 4],
            ['name' => 'ghfgh', 'star' => 3]
        ];
        return view('hotels', compact('hotels', 'tab'));
    }

    public function contacts()
    {
        $tab = 'contacts';

        return view('contacts', compact('tab'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        // send email

        // return redirect('/contacts');
        return back()->with('success', 'Thank you!');
    }

    public function category(Category $category)
    {
        $tab = 'home';
        $products = Product::where('category_id', $category->id)->paginate(3);
        return view('category', compact('category', 'products', 'tab'));
    }

    public function product(Product $product)
    {
        $tab = 'home';
        $category = $product->category;
        return view('product', compact('category', 'product','tab'));
    }
    public function tag(Tag $tag)
    {
        $tab = 'home';
        $products = $tag->products;
        return view('tag', compact('products', 'tag','tab'));
    }
}
