<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class SiteController extends Controller
{
    public function index()
    {
        $title = 'Homepage';

        return view('site.home', compact('title'));
    }
}
