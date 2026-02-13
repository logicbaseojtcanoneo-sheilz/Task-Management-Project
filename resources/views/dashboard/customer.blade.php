<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f5f5f5;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
        .btn-create-task {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        .btn-create-task:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }
        .task-card {
            border-left: 5px solid #667eea;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
        }
        .status-in-progress {
            background: #cfe2ff;
            color: #084298;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
        }
        .status-completed {
            background: #d1e7dd;
            color: #0f5132;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
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
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-12">
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

                    <!-- Projects Section -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Your Projects</h5>
                        </div>
                        <div class="card-body">
                            @if ($projects->count() > 0)
                                <div class="row">
                                    @foreach ($projects as $project)
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $project->name }}</h6>
                                                    <p class="card-text text-muted small">{{ $project->description }}</p>
                                                    <a href="{{ route('task.create', $project->id) }}" class="btn btn-sm btn-create-task">
                                                        <i class="fas fa-plus"></i> Create Task
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">You have no projects yet. Please contact your administrator.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Tasks Section -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Your Created Tasks</h5>
                        </div>
                        <div class="card-body">
                            @if ($tasks->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Project</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $task->title }}</strong><br>
                                                        <small class="text-muted">{{ $task->description ? Str::limit($task->description, 50) : 'No description' }}</small>
                                                    </td>
                                                    <td>{{ $task->project->name }}</td>
                                                    <td>
                                                        <span class="category-badge category-{{ $task->category }}">
                                                            {{ ucfirst($task->category) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($task->status === 'pending')
                                                            <span class="status-pending">Pending</span>
                                                        @elseif ($task->status === 'in_progress')
                                                            <span class="status-in-progress">In Progress</span>
                                                        @elseif ($task->status === 'completed')
                                                            <span class="status-completed">Completed</span>
                                                        @else
                                                            <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $task->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('task.show', $task->id) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('task.delete', $task->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">You haven't created any tasks yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
