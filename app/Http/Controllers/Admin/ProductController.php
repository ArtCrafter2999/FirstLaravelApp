<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tab = "products";
        $products = Product::with('category')->paginate(5);
        return view('admin.products.index', compact('products', 'tab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $tab = "products";
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('admin.products.create', compact('categories', 'tab', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create($request->all());
        $product->tags()->sync($request->tags);
//        if ($request->image) {
//            $product->image = $request->image->store('uploads');
//            $product->save();
//        }

        return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit(Product $product)
    {
        $tab = "products";
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('admin.products.edit', compact('categories', 'product', 'tags', 'tab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $product->update($request->all());
        $product->tags()->sync($request->tags);
//        if ($request->image) {
//            $product->image = $request->image->store('uploads');
//            $product->save();
//        }

        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/admin/products');
    }
}
