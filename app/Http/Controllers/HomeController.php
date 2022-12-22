<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display first page after login (dashboard page)
     */
    public function home(Request $request)
    {
        return Inertia::render('Home');
    }
}
