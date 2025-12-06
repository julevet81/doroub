<?php

namespace App\Http\Controllers;

use App\Models\AssistanceItem;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = AssistanceItem::all();
        return view('projects.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|max:50',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'تم إنشاء المشروع بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $projectData = $project->toArray();
        return view('projects.show', compact('projectData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|max:50',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'تم تحديث المشروع بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'تم حذف المشروع بنجاح.');
    }
}
