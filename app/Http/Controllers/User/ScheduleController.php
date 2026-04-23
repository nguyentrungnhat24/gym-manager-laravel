<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LichTap;

class ScheduleController extends Controller
{
    public function index()
    {
        $lichTaps = LichTap::all();
        return view('user.schedule', compact('lichTaps'));
    }

    public function schedule1()
    {
        $lichTaps = LichTap::all();
        return view('user.schedule1', compact('lichTaps'));
    }

    public function schedule2()
    {
        $lichTaps = LichTap::all();
        return view('user.schedule2', compact('lichTaps'));
    }

    public function filterByDate(Request $request)
    {
        $date = $request->input('date');
        $lichTaps = LichTap::whereDate('ngay', $date)->get();
        
        return view('user.schedule', compact('lichTaps', 'date'));
    }
}
