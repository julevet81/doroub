<?php

namespace App\Http\Controllers;

use App\Models\AssistanceItem;
use App\Models\Project;
use App\Models\Volunteer;
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

    public function create()
    {
        $assistanceItems = AssistanceItem::all();
        $volunteers = Volunteer::all();

        return view('projects.create', compact('assistanceItems', 'volunteers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'amount' => 'nullable|numeric',
            'status' => 'required|string',
            'notes' => 'nullable|string',

            'items.*.item_id' => 'required|exists:assistance_items,id',
            'items.*.quantity' => 'required|integer|min:1',

            'volunteers.*.id' => 'required|exists:volunteers,id',
            'volunteers.*.position' => 'nullable|string|max:255',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        foreach ($request->items as $item) {
            $project->assistances()->attach($item['item_id'], [
                'quantity' => $item['quantity']
            ]);

            AssistanceItem::where('id', $item['item_id'])
                ->decrement('quantity_in_stock', $item['quantity']);
        }

        
        foreach ($request->volunteers as $vol) {
            $project->volunteers()->attach($vol['id'], [
                'position' => $vol['position']
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'تم إنشاء المشروع بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $projectData = [
            'الإسم' => $project->name,
            'النوع' => $project->type,
            'المبلغ' => $project->budget,
            'تاريخ الدء' => $project->start_date,
            'تاريخ الانتهاء' => $project->end_date,
            'الحالة' => $project->status,
            'الموقع' => $project->location,
            'التفاصيل' => $project->description,
        ];
        return view('projects.show', compact('projectData'));
    }

    public function edit(Project $project)
    {
        $assistanceItems = AssistanceItem::all();
        $volunteers = Volunteer::all();

        // جلب عناصر المشروع
        $projectItems = $project->assistances()->get();

        // جلب متطوعي المشروع
        $projectVolunteers = $project->volunteers()->get();

        return view('projects.edit', compact(
            'project',
            'assistanceItems',
            'volunteers',
            'projectItems',
            'projectVolunteers'
        ));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'amount' => 'nullable|numeric',
            'status' => 'required|string',
            'notes' => 'nullable|string',

            'items.*.item_id' => 'required|exists:assistance_items,id',
            'items.*.quantity' => 'required|integer|min:1',

            'volunteers.*.id' => 'required|exists:volunteers,id',
            'volunteers.*.position' => 'nullable',
        ]);

        
        foreach ($project->assistances as $old) {
            AssistanceItem::where('id', $old->id)
                ->increment('quantity_in_stock', $old->pivot->quantity);
        }

        
        $project->update([
            'name' => $request->name,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

    
        $project->assistances()->detach();
        $project->volunteers()->detach();


        foreach ($request->items as $item) {
            $project->assistances()->attach($item['item_id'], [
                'quantity' => $item['quantity']
            ]);

            AssistanceItem::where('id', $item['item_id'])
                ->decrement('quantity_in_stock', $item['quantity']);
        }

        
        foreach ($request->volunteers as $vol) {
            $project->volunteers()->attach($vol['id'], [
                'position' => $vol['position']
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'تم تحديث المشروع بنجاح');
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
