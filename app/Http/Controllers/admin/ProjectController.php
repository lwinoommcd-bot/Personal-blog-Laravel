<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(5);
        return view('admin-panel.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
        ]);

        Project::create([
            'tag' => $request->tag,
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link
        ]);

        return redirect('admin/projects')->with('successMsg', 'Successful Created..');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view('admin-panel.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'tag' => 'required',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);

        $project->update([
            'tag' => $request->tag,
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link

        ]);

        return redirect('admin/projects')->with('successMsg', 'Successful Updated..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect('admin/projects')->with('successMsg', 'Successful Deleted..');

    }
}
