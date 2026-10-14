<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|max:2000',
        ]);
        Contact::create($data);

        return back()->with('success', 'Cảm ơn bạn, chúng tôi đã nhận được liên hệ.');
    }
}