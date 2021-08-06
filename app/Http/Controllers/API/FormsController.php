<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function process_index()
    {
        return view('pages/dashboard/processes');
    }

    public function download_index()
    {
        return view('pages/dashboard/download');
    }
}
