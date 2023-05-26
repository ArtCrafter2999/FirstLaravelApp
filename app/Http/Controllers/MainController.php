<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Carbon\PHPStan\Macro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use LiqPay;

class MainController extends Controller
{
    public function home()
    {
        $tab = 'home';
        $products = Product::orderBy('created_at', 'DESC')->paginate(4);
        return view('home', compact('products', 'tab'));
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

        //telegram
        // https://api.telegram.org/bot token /sendMessage&text=Hello
        $data = [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => "$name \r\n $email \r\n $message"
        ];
        $ch = curl_init('https://api.telegram.org/bot' . env('TELEGRAM_BOT') . '/sendMessage?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        // send email
        Mail::to('artcrafter2999@gmail.com')->send(new ContactEmail(compact('name', 'email', 'message')));
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
        return view('product', compact('category', 'product', 'tab'));
    }

    public function tag(Tag $tag)
    {
        $tab = 'home';
        $products = $tag->products;
        return view('tag', compact('products', 'tag', 'tab'));
    }

    public function checkout()
    {
        $user = Auth::user();
        if($user == null) return redirect('login');
        $public_key = env('LIQPAY_PUBLIC');
        $private_key = env('LIQPAY_PRIVATE');

        $order_id = time();
        $cart = Session::get('cart');
        $totalSum = Session::get('totalSum');

        $liqpay = new LiqPay($public_key, $private_key);
        $html = $liqpay->cnb_form(array(
            'action' => 'pay',
            'amount' => $totalSum,
            'currency' => 'UAH',
            'description' => 'description text',
            'order_id' => $order_id,
            'version' => '3',
            'result_url' => env('app_url') . '/api/pay-callback?order_id='.$order_id
        ));


        return view('checkout', compact('html', 'cart', 'totalSum'));
    }

    public function pay(Request $request)
    {
        $public_key = env('LIQPAY_PUBLIC');
        $private_key = env('LIQPAY_PRIVATE');

        $sign = base64_encode( sha1(
            $private_key .
            $request->data .
            $private_key
            , 1 ));
        if($sign === $request->signature){
            $liqpay = new LiqPay($public_key, $private_key);
            $res = $liqpay->api("request", array(
                'action' => 'status',
                'version' => '3',
                'order_id' => $request->order_id
            ));
            if($res->status == 'success'){
                dd('OK');
            }
            else{
                dd("Error");
            }
        }
        else {
            dd('Error');
        }
    }
}
