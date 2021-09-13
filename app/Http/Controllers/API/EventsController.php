<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Throwable;

class EventsController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/events');
    }

    public function getEvents()
    {
        return Event::orderBy('event_date', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $events_file = null;

        if ($request->file('events_file') != null) {
            $file = $request->file('events_file');
            $fileName1 = $file->getClientOriginalName();
            $request->file('events_file')->move(base_path('public/files/event_files'), $fileName1);
            $events_file = 'files/event_files/' . $fileName1;
        }

        $create = Event::create([
            'name' => $request->name,
            'summary' => $request->summary,
            'full_details' => $request->full_details,
            'target_audience' => $request->target_audience,
            'type' => $request->type,
            'pubmat_img' => $events_file,
            'event_date' => $request->event_date
        ]);

        if ($create->saveOrFail()) {
            return response()->json(['message' => 'Event is saved.']);
        } else {
            return response()->json(['message' => 'Event is not saved.']);
        }
    }

    public function delete(Request $request)
    {
        try {
            $delete = Event::where('id', $request->id)->delete();

            return response()->json(['message' => 'Event is deleted.']);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Failed to delete.']);
        }
    }

    public function editEvent(Request $request)
    {
        $edit = Event::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'summary' => $request->summary,
            'full_details' => $request->full_details,
            'target_audience' => $request->target_audience,
            'type' => $request->type,
            'event_date' => $request->event_date
        ]);
    }

}
