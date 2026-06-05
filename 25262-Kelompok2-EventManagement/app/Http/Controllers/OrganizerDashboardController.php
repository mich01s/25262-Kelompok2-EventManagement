<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizerDashboardController extends Controller
{
    public function index()
    {
        return view('event_organizer.dashboard.index');
    }
}
