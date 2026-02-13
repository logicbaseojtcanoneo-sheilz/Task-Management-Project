<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f5f5f5;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .container {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .task-detail {
            margin-bottom: 20px;
        }
        .task-detail label {
            font-weight: bold;
            color: #667eea;
        }
        .task-detail p {
            margin-left: 10px;
            font-size: 16px;
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
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }
        .category-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Task Details</h5>
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-light">Back to Dashboard</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="task-detail">
                            <label>Task ID</label>
                            <p>#{{ $task->id }}</p>
                        </div>

                        <div class="task-detail">
                            <label>Title</label>
                            <p>{{ $task->title }}</p>
                        </div>

                        <div class="task-detail">
                            <label>Project</label>
                            <p>{{ $task->project->name }}</p>
                        </div>

                        <div class="task-detail">
                            <label>Description</label>
                            <p>{{ $task->description ?? 'No description provided' }}</p>
                        </div>

                        <div class="task-detail">
                            <label>Category</label>
                            <p>
                                <span class="category-badge category-{{ $task->category }}">
                                    {{ ucfirst($task->category) }}
                                </span>
                            </p>
                        </div>

                        <div class="task-detail">
                            <label>Status</label>
                            <p>
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
                            </p>
                        </div>

                        <div class="task-detail">
                            <label>Created By</label>
                            <p>{{ $task->creator->name }}</p>
                        </div>

                        <div class="task-detail">
                            <label>Created At</label>
                            <p>{{ $task->created_at->format('F d, Y \a\t H:i') }}</p>
                        </div>

                        @if (Auth::user()->role !== 'customer')
                            <div class="task-detail">
                                <label>Last Updated</label>
                                <p>{{ $task->updated_at->format('F d, Y \a\t H:i') }}</p>
                            </div>
                        @endif

                        @if (Auth::user()->role !== 'customer')
                            <div class="mt-4">
                                <h6>Update Task Status</h6>
                                <form action="{{ route('task.update-status', $task->id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select" required>
                                        <option value="">Select new status...</option>
                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $task->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        @endif

                        @if (Auth::user()->role === 'customer' && $task->created_by === Auth::id())
                            <div class="mt-4">
                                <form action="{{ route('task.delete', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="fas fa-trash"></i> Delete Task
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
