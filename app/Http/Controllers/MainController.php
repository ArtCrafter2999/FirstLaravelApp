<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $tab = 'home';
        return view('home', compact('tab'));
    }
    public function hotels()
    {
        $tab = 'hotels';
        $hotels = [
            ['name'=>'dfgdfg', 'star'=>4],
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
}
