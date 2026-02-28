<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('contacts.create', compact('categories'))
                ->with('inputs', $request->all());
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        return view('contacts.confirm', compact('inputs'));
    }

    public function store(Request $request)
    {
        $tel = $request->tel1 . '-' . $request->tel2 .'-' . $request->tel3;

        Contact::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'address' => $request->address,
            'building' => $request->building,
            'category_id' => $request->category_id,
            'detail' => $request->detail,
            'tel' => $tel,
        ]);
        return view('contacts.thanks');
    }
}
