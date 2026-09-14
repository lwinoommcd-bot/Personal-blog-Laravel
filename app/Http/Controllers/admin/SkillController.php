<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::paginate(6);
        return view('admin-panel.skill.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'percent' => 'required'
        ]);
        Skill::create([
            'name' => $request->name,
            'percent' => $request->percent
        ]);
        return redirect('admin/skills')->with('successMsg', 'SuccessFul Created..');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skill = Skill::find($id);
        return view('admin-panel.skill.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required',
            'percent' => 'required'
        ]);

        $skill->update([
            'name' => $request->name,
            'percent' => $request->percent
        ]);
        return redirect('admin/skills')->with('successMsg', 'Successful Updated..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Skill::destroy($id);
        return redirect('admin/skills')->with('successMsg', 'Successful Deleted..');
    }
}
