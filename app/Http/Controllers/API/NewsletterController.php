<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\NewsletterImage;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/newsletter');
    }

    public function getNewsletter()
    {
        return Newsletter::orderBy('date_published', 'DESC')->with('newsletter_images')->get();
    }

    public function store(Request $request)
    {
        // $create = Newsletter::create([
        //     'title' => $request->title,
        //     'date_published' => $request->date_published,
        //     'status' => $request->status,
        // ]);
        $create = new Newsletter;
        $create->title = $request->title;
        $create->date_published = $request->date_published;
        $create->status = $request->status;
        $create->save();
        
        $image = null;
        $image_files = $request->file('image');
        $length = count($request->file('image'));
        // dd($image_files[1]);

        if ($request->file('image') != null) {
            for ($i = 0; $i < $length; $i++) {
                $file = $image_files[$i];
                $fileName1 = $file->getClientOriginalName();
                $image_files[$i]->move(base_path('public/files/newsletter_files'), $fileName1);
                $image = 'files/newsletter_files/' . $fileName1;

                $nl = NewsletterImage::create([
                    'newsletter_id' => $create->id,
                    'image' => $image,
                ]);
            }
        }

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