<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Forms;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/processes');
    }

    public function getForms()
    {
        return Forms::orderBy('created_at', 'ASC')->get();
    }

    public function store(Request $request) 
    {
        $audio_file = null;
        $video_file = null;
        $instruction_file = null;

        if ($request->file('audio_file') != null) {
            $file = $request->file('audio_file');
            $fileName1 = $file->getClientOriginalName();
            $request->file('audio_file')->move(base_path('public/files/audio_files'), $fileName1);
            $audio_file = 'files/audio_files/' . $fileName1;
        }
        if ($request->file('video_file') != null) {
            $file = $request->file('video_file');
            $fileName1 = $file->getClientOriginalName();
            $request->file('video_file')->move(base_path('public/files/video_files'), $fileName1);
            $video_file = 'files/video_files/' . $fileName1;
        }
        if ($request->file('instruction_file') != null) {
            $file = $request->file('instruction_file');
            $fileName1 = $file->getClientOriginalName();
            $request->file('instruction_file')->move(base_path('public/files/instruction_files'), $fileName1);
            $instruction_file = 'files/instruction_files/' . $fileName1;
        }

        $create = Forms::create([
            'form_title' => $request->form_title,
            'form_description' => $request->form_desc,
            'process_title' => $request->process_title,
            'process_description' => $request->process_desc,
            'audio_file' => $audio_file,
            'video_file' => $video_file,
            'instruction_file' => $instruction_file
        ]);

        if ($create->saveOrFail()) {
            return response()->json(['message' => 'Form is saved.']);
        } else {
            return response()->json(['message' => 'Form is not saved.']);
        }
    }
    
    public function delete(Request $request)
    {
            $delete = Forms::where('id', $request->id)->delete();

            return response()->json(['message' => 'Form is deleted.']);
    }
}
