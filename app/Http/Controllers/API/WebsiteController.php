<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('pages/website/index');
    }

    public function processes()
    {
        return view('pages/website/processes');
    }

    public function forms()
    {
        return view ('pages/website/forms');
    }

    public function events()
    {
        return view ('pages/website/events');
    }

    public function blog()
    {
        return view ('pages/website/blog');
    }

    public function know_us()
    {
        return view ('pages/website/know_us');
    }

    public function directories()
    {
        return view ('pages/website/directories');
    }
}
