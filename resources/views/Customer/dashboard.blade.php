<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Customer Dashboard</title>
<style>
body { font-family:'Segoe UI', sans-serif; background:#f4f6f8; margin:0; }
header { background:#2a2f4a; color:white; padding:20px; display:flex; justify-content:space-between; align-items:center; }
header a { color:white; text-decoration:none; background:#ff4d6d; padding:8px 16px; border-radius:5px; }
.dashboard-container { max-width:900px; margin:40px auto; padding:0 20px; }
.stats-cards { display:flex; justify-content:space-between; margin-bottom:40px; }
.card { background:white; padding:20px; border-radius:10px; flex:1; margin:0 10px; text-align:center; box-shadow:0 4px 15px rgba(0,0,0,0.1); }
.actions { text-align:center; }
button, .btn { background-color:#2a2f4a; color:white; padding:12px 20px; border:none; border-radius:6px; cursor:pointer; text-decoration:none; display:inline-block; margin-top:10px; }
button:hover, .btn:hover { background-color:#1b1f35; }
</style>
</head>
<body>
<header>
    <h1>Dashboard</h1>
    <a href="{{ route('logout') }}">Logout</a>
</header>
<main class="dashboard-container">
    <div class="stats-cards">
        <div class="card"><h3>Total Tasks</h3><p>{{ $tasks->count() }}</p></div>
        <div class="card"><h3>Pending</h3><p>{{ $tasks->where('status','Pending')->count() }}</p></div>
        <div class="card"><h3>Completed</h3><p>{{ $tasks->where('status','Completed')->count() }}</p></div>
    </div>
    <div class="actions">
        <a href="{{ route('tasks.create') }}" class="btn">Create Task</a>
        <a href="{{ route('tasks.index') }}" class="btn">View Tasks</a>
    </div>
</main>
</body>
</html>