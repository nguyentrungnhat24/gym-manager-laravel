<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PT;

class TrainerController extends Controller
{
    public function index()
    {
        $pts = PT::all();
        return view('user.trainer', compact('pts'));
    }

    public function show($id)
    {
        $pt = PT::findOrFail($id);
        return view('user.trainer.detail', compact('pt'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $pts = PT::where('tenpt', 'like', "%{$query}%")
            ->orWhere('mota', 'like', "%{$query}%")
            ->get();
        
        return view('user.trainer', compact('pts', 'query'));
    }
}
