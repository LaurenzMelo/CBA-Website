<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/newsletter');
    }

    public function getNewsletter()
    {
        return Newsletter::orderBy('date_published', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $image = null;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $fileName1 = $file->getClientOriginalName();
            $request->file('image')->move(base_path('public/files/newsletter_files'), $fileName1);
            $image = 'files/newsletter_files/' . $fileName1;
        }

        $create = Newsletter::create([
            'title' => $request->title,
            'date_published' => $request->date_published,
            'status' => $request->status,
            'image' => $image
        ]);

        if ($create->saveOrFail()) {
            return response()->json(['message' => 'Newsletter is saved.']);
        } else {
            return response()->json(['message' => 'Newsletter is not saved.']);
        }
    }

    public function delete(Request $request)
    {
        $delete = Newsletter::where('id', $request->id)->delete();

        return response()->json(['message' => 'Blog is deleted.']);
    }

    public function editNewsletter(Request $request) 
    {
        $edit = Newsletter::where('id', $request->id)
                ->update([
                    'title' => $request->title,
                    'date_published' => $request->date_published,
                    'status' => $request->status
                ]);
    }
}