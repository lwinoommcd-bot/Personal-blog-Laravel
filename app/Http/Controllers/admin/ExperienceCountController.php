<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExperienceCount;
use Illuminate\Http\Request;

class ExperienceCountController extends Controller
{
    public function index()
    {
        $experience = ExperienceCount::first();
        return view('admin-panel.experience.index', compact('experience'));
    }

    public function edit($id)
    {
        $experience = ExperienceCount::first();
        return view('admin-panel.experience.edit', compact('experience'));
    }

    public function update(Request $request, ExperienceCount $experienceCount)
    {
        $request->validate([
            'count' => 'required'
        ]);
        $experienceCount->update([
            'count' => $request->count
        ]);

        return back()->with('successMsg', 'SuccessFul Updated to ' . $request->count . ' years experience');
    }
}
