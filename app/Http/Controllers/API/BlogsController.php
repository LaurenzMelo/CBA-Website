<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Throwable;

class BlogsController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/blogs');
    }
    
    public function store(Request $request)
    {
        $blog_file = null;

        if ($request->file('blog_file') != null) {
            $file = $request->file('blog_file');
            $fileName1 = $file->getClientOriginalName();
            $request->file('blog_file')->move(base_path('public/files/blog_files'), $fileName1);
            $blog_file = 'files/blog_files/' . $fileName1;
        }

        $create = Blog::create([
            'title' => $request->title,
            'author_name' => $request->author_name,
            'date_published' => $request->date_published,
            'content' => $request->content,
            'image' => $blog_file
        ]);

        if ($create->saveOrFail()) {
            return response()->json(['message' => 'Blog is saved.']);
        } else {
            return response()->json(['message' => 'Blog is not saved.']);
        }
    }

    public function getAllBlog()
    {
        return Blog::orderBy('date_published', 'DESC')->get();
    }

    public function getBlog() 
    {
        $data['side_blogs'] = Blog::skip(1)->take(8)->orderBy('date_published', 'DESC')->get();
        $data['featured_blog'] = Blog::orderBy('date_published', 'DESC')->first();

        return response()->json($data);
    }

    public function getIndBlog($id)
    {
        $ind_blog = Blog::findOrFail($id);

        return view('pages.website.ind_blog', compact('ind_blog'));
    }

    public function delete(Request $request)
    {
        try {
            $delete = Blog::where('id', $request->id)->delete();

            return response()->json(['message' => 'Blog is deleted.']);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Failed to delete.']);
        }
    }

    public function editBlog(Request $request) 
    {
        $edit = Blog::where('id', $request->id)
                ->update([
                    'title' => $request->title,
                    'author_name' => $request->author_name,
                    'date_published' => $request->date_published,
                    'content' => $request->content,
                ]);
    }
}
