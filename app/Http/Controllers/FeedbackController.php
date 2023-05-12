<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $tab = 'feedback';
        $feedbacks = Feedback::all();
        return view('admin.feedback', compact('feedbacks', 'tab'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'from' => 'required|max:30',
            'rate' => 'required|gte:1|lte:10',
            'comment' => 'required'
        ]);
        $feedback = new Feedback();
        $feedback->from = $request->from;
        $feedback->rate = $request->rate;
        $feedback->comment = $request->comment;
        $feedback->save();
        return redirect('/feedback');
    }
}
