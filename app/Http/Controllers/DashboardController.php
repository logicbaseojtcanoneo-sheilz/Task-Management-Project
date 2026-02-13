<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        switch ($user->role) {
            case 'customer':
                return $this->customerDashboard($user);
            case 'frontend_developer':
            case 'backend_developer':
            case 'server_admin':
                return $this->developerDashboard($user);
            default:
                return redirect('/login');
        }
    }

    private function customerDashboard($user)
    {
        $projects = $user->customerProjects()->with('assignment')->get();
        $tasks = Task::where('created_by', $user->id)
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.customer', [
            'projects' => $projects,
            'tasks' => $tasks,
        ]);
    }

    private function developerDashboard($user)
    {
        // Get all projects where this user is assigned
        $projects = [];
        $allProjects = Project::all();

        foreach ($allProjects as $project) {
            $assignment = $project->assignment;
            if ($assignment) {
                if (
                    ($user->role === 'frontend_developer' && $assignment->frontend_dev_id === $user->id) ||
                    ($user->role === 'backend_developer' && $assignment->backend_dev_id === $user->id) ||
                    ($user->role === 'server_admin' && $assignment->server_admin_id === $user->id)
                ) {
                    $projects[] = $project;
                }
            }
        }

        $tasks = Task::where('assigned_to', $user->id)
            ->with('project', 'creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.developer', [
            'projects' => $projects,
            'tasks' => $tasks,
            'userRole' => $user->role,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}