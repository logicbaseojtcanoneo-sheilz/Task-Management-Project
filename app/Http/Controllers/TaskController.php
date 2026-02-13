<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create($projectId)
    {
        $project = Project::find($projectId);
        
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        // Verify that the authenticated user is the customer of this project
        if ($project->customer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        return view('task.create', [
            'project' => $project,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:frontend,backend,server',
        ]);

        $project = Project::find($validated['project_id']);

        // Verify that the authenticated user is the customer of this project
        if ($project->customer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        // Get the project assignment
        $assignment = ProjectAssignment::where('project_id', $project->id)->first();

        if (!$assignment) {
            return redirect()->back()->with('error', 'Project does not have assigned developers');
        }

        // Determine who to assign based on category
        $assignedTo = null;
        if ($validated['category'] === 'frontend') {
            $assignedTo = $assignment->frontend_dev_id;
        } elseif ($validated['category'] === 'backend') {
            $assignedTo = $assignment->backend_dev_id;
        } elseif ($validated['category'] === 'server') {
            $assignedTo = $assignment->server_admin_id;
        }

        if (!$assignedTo) {
            return redirect()->back()->with('error', 'No developer assigned for this category');
        }

        $task = Task::create([
            'project_id' => $validated['project_id'],
            'created_by' => Auth::id(),
            'assigned_to' => $assignedTo,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Task created successfully');
    }

    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        $user = Auth::user();

        // Customer can only see their own created tasks
        if ($user->role === 'customer' && $task->created_by !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        // Developer can only see tasks assigned to them
        if (in_array($user->role, ['frontend_developer', 'backend_developer', 'server_admin']) && $task->assigned_to !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        return view('task.show', [
            'task' => $task,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        $user = Auth::user();

        // Only assigned developer can update status
        if ($task->assigned_to !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $task->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Task status updated');
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        $user = Auth::user();

        // Only the creator can delete
        if ($task->created_by !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $task->delete();

        return redirect()->back()->with('success', 'Task deleted');
    }
}