<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/announcements');
    }

    public function allAnnouncement()
    {
        $all = Announcement::orderBy('announcement_date', 'DESC')->get();

        return view('pages/website/all_announcement', compact('all'));
    }

    public function getAnnouncement()
    {
        return Announcement::orderBy('announcement_date')->get();
    }

    public function getThreeAnnouncement()
    {
        return Announcement::orderBy('announcement_date', 'DESC')
            ->take(3)
            ->get();
    }

    public function store(Request $request)
    {
        $create = Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
            'announcement_date' => $request->announcement_date,
        ]);

        if ($create->saveOrFail()) {
            return response()->json(['message' => 'Announcement is saved.']);
        } else {
            return response()->json(['message' => 'Announcement is not saved.']);
        }
    }

    public function delete(Request $request)
    {
        $delete = Announcement::where('id', $request->id)->delete();

        return response()->json(['message' => 'Announcement is deleted.']);
    }
    
    public function editAnn(Request $request)
    {
        $edit = Announcement::where('id', $request->id)
                ->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'announcement_date' => $request->announcement_date,
                ]);
    }
}
