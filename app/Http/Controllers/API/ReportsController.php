<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/reports');
    }

    public function transparencyReports() 
    {
        $t_report = Report::where('type', 'Transparency')->orderBy('event_date', 'DESC')->get();
        
        return view('pages/website/transparency_report', compact('t_report'));
    }

    public function progressReports() 
    {
        $p_report = Report::where('type', 'Progress')->orderBy('event_date', 'DESC')->get();
        
        return view('pages/website/progress_report', compact('p_report'));
    }

    public function getReports()
    {
        return Report::orderBy('event_date')->get();
    }

    public function getProgressReports()
    {
        return Report::where('type', 'Progress')
            ->orderBy('event_date', 'DESC')
            ->take(3)
            ->get();
    }

    public function getTransparencyReports()
    {
        return Report::where('type', 'Transparency')
            ->orderBy('event_date', 'DESC')
            ->take(3)
            ->get();
    }

    public function store(Request $request)
    {
        $report_file = null;

        if ($request->file('report_file') != null) {
            $file = $request->file('report_file');
            $fileName1 = $file->getClientOriginalName();
            $request->file('report_file')->move(base_path('public/files/report_files'), $fileName1);
            $report_file = 'files/report_files/' . $fileName1;
        }

        $create = Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'type' => $request->type,
            'file' => $report_file
        ]);

        if ($create->saveOrFail()) {
            return response()->json(['message' => 'Report is saved.']);
        } else {
            return response()->json(['message' => 'Report is not saved.']);
        }
    }

    public function delete(Request $request)
    {
        $delete = Report::where('id', $request->id)->delete();

        return response()->json(['message' => 'Report is deleted.']);
    }
}
