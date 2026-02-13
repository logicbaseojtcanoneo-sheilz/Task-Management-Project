<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
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
        .form-control, .form-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 30px;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
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
                            <h5 class="mb-0">Create New Task</h5>
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-light">Back to Dashboard</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('task.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    value="{{ $project->name }}" 
                                    disabled
                                >
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                <small class="text-muted">{{ $project->description }}</small>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Task Title *</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    id="title" 
                                    name="title" 
                                    value="{{ old('title') }}"
                                    required
                                    placeholder="Enter task title"
                                >
                                @error('title')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Task Description</label>
                                <textarea 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    id="description" 
                                    name="description" 
                                    rows="5"
                                    placeholder="Enter task description (optional)"
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Task Category *</label>
                                <select 
                                    class="form-select @error('category') is-invalid @enderror" 
                                    id="category" 
                                    name="category" 
                                    required
                                >
                                    <option value="">Select a category...</option>
                                    <option value="frontend" {{ old('category') === 'frontend' ? 'selected' : '' }}>Frontend Development</option>
                                    <option value="backend" {{ old('category') === 'backend' ? 'selected' : '' }}>Backend Development</option>
                                    <option value="server" {{ old('category') === 'server' ? 'selected' : '' }}>Server Administration</option>
                                </select>
                                @error('category')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-2">
                                    The task will be automatically assigned to the corresponding developer based on the selected category.
                                </small>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-submit">Create Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
