<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Illuminate\Events\queueable;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->id);
        $prev = Session::get('cart.'.$product->id);
        $quantity = $request->quantity;
        if($prev)
            $quantity += $prev['quantity'];
        $data = [
          'id' => $product->id,
          'image' => $product->image,
          'title' => $product->title,
          'price' => $product->price,
          'quantity' => $quantity
        ];
        Session::put('cart.'.$product->id, $data);
        $this->totalSum();
        return view('_modal-cart-dialog');
    }
    public function remove(int $id){
        Session::forget('cart.'.$id);
        $this->totalSum();
        return view('_modal-cart-dialog');
    }
    public function clear(){
        Session::forget('cart');
        Session::forget('totalSum');
        $this->totalSum();
        return view('_modal-cart-dialog');
    }
    public function totalSum(){
        $items = Session::get('cart');
        $sum = 0;
        if($items){
            foreach ($items as $item){
                $sum += $item['price'] * $item['quantity'];
            }
        }
        Session::put('totalSum', $sum);
    }
}
