<?php

namespace App\Http\Controllers;

use App\Models\ProjectAssistance;
use Illuminate\Http\Request;

class ProjectAssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectAssistances = ProjectAssistance::all();
        return view('project_assistances.index', compact('projectAssistances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project_assistances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric',
        ]);
        ProjectAssistance::create($request->all());
        return redirect()->route('project_assistances.index')->with('success', 'Project Assistance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectAssistance $projectAssistance)
    {
        return view('project_assistances.show', compact('projectAssistance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectAssistance $projectAssistance)
    {
        return view('project_assistances.edit', compact('projectAssistance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectAssistance $projectAssistance)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric',
        ]);
        $projectAssistance->update($request->all());
        return redirect()->route('project_assistances.index')->with('success', 'Project Assistance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectAssistance $projectAssistance)
    {
        $projectAssistance->delete();
        return redirect()->route('project_assistances.index')->with('success', 'Project Assistance deleted successfully.');
    }
}
