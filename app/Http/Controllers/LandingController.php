<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $announcements = DB::table('announcements')
            ->orderByDesc('id')          // simple + safe
            ->orderByDesc('created_at')  // optional: if timestamps exist
            ->limit(5)
            ->get();

        return view('landing', compact('announcements'));
    }
}
