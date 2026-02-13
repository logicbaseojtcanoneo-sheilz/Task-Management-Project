<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f5f5f5;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .main-content {
            padding: 20px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .badge-role {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
        }
        .task-card {
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
        }
        .task-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-in-progress {
            background: #cfe2ff;
            color: #084298;
        }
        .status-completed {
            background: #d1e7dd;
            color: #0f5132;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }
        .category-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .category-frontend {
            background: #e7f3ff;
            color: #0066cc;
        }
        .category-backend {
            background: #ffe7e7;
            color: #cc0000;
        }
        .category-server {
            background: #e7ffe7;
            color: #009900;
        }
        .update-status-form {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-tasks"></i> Task Manager
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text text-white me-3">{{ Auth::user()->name }}</span>
                <span class="badge-role me-3">
                    @if (Auth::user()->role === 'frontend_developer')
                        Frontend Developer
                    @elseif (Auth::user()->role === 'backend_developer')
                        Backend Developer
                    @elseif (Auth::user()->role === 'server_admin')
                        Server Administrator
                    @endif
                </span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="main-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Assigned Projects -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Assigned Projects</h5>
                </div>
                <div class="card-body">
                    @if (count($projects) > 0)
                        <div class="row">
                            @foreach ($projects as $project)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $project->name }}</h6>
                                            <p class="card-text text-muted small">
                                                Customer: {{ $project->customer->name }}
                                            </p>
                                            <p class="card-text text-muted small">
                                                {{ $project->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">You are not assigned to any projects yet.</p>
                    @endif
                </div>
            </div>

            <!-- Assigned Tasks -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Your Assigned Tasks</h5>
                </div>
                <div class="card-body">
                    @if ($tasks->count() > 0)
                        <div class="row">
                            @foreach ($tasks as $task)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card task-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="card-title">{{ $task->title }}</h6>
                                                <span class="category-badge category-{{ $task->category }}">
                                                    {{ ucfirst($task->category) }}
                                                </span>
                                            </div>
                                            <p class="card-text text-muted small">
                                                {{ $task->description ? Str::limit($task->description, 60) : 'No description' }}
                                            </p>
                                            <p class="text-muted small">
                                                <strong>Project:</strong> {{ $task->project->name }}
                                            </p>
                                            <p class="text-muted small">
                                                <strong>Created by:</strong> {{ $task->creator->name }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="status-badge 
                                                    @if ($task->status === 'pending')
                                                        status-pending
                                                    @elseif ($task->status === 'in_progress')
                                                        status-in-progress
                                                    @elseif ($task->status === 'completed')
                                                        status-completed
                                                    @endif
                                                ">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </div>

                                            <!-- Status Update Form -->
                                            <div class="mt-3">
                                                <form action="{{ route('task.update-status', $task->id) }}" method="POST" class="update-status-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" class="form-select form-select-sm" required>
                                                        <option value="">Change status...</option>
                                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="cancelled" {{ $task->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">You have no assigned tasks yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
