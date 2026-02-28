<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\user;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->keyword) {
             $keyword = str_replace([' ', '　'], '', $request->keyword);

    $query->where(function ($q) use ($keyword) {
        $q->where('last_name', 'like', '%' . $keyword . '%')
          ->orWhere('first_name', 'like', '%' . $keyword . '%')
          ->orWhere('email', 'like', '%' . $keyword . '%')
          ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $keyword . '%']);
        });
    }

    if ($request->gender && $request->gender != 'all') {
        $query->where('gender', $request->gender);
    }

    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->latest()->paginate(7)->appends($request->query());
    $categories = Category::all();

    return view('admin.index', compact('contacts', 'categories'));
    }

    public function export(Request $request)
{
    $query = Contact::query();

    if ($request->keyword) {
        $query->where(function ($q) use ($request) {
            $q->where('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->gender) {
        $query->where('gender', $request->gender);
    }

    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->with('category')->get();

    $response = new StreamedResponse(function () use ($contacts) {

        $handle = fopen('php://output', 'w');

        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($handle, [
            'お名前',
            '性別',
            'メール',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
            '作成日'
        ]);

        foreach ($contacts as $contact) {

            $gender = $contact->gender == 1 ? '男性' :
                      ($contact->gender == 2 ? '女性' : 'その他');

            fputcsv($handle, [
                $contact->last_name . ' ' . $contact->first_name,
                $gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '',
                $contact->detail,
                $contact->created_at,
            ]);
        }

        fclose($handle);
    });

    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

    return $response;
    }

    public function destroy($id)
    {
    Contact::findOrFail($id)->delete();

    return redirect('/admin')->with('message', '削除しました');
    }
}
