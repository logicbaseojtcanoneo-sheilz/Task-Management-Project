<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Tasks</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: Inter, sans-serif;
    background:#0b1020;
    color:#e5e7eb;
}
.container {
    max-width:900px;
    margin:auto;
    padding:40px 20px;
}
.card {
    background:#131a33;
    padding:20px;
    border-radius:16px;
    display:flex;
    justify-content:space-between;
    margin-bottom:15px;
}
.status {
    padding:6px 14px;
    border-radius:999px;
}
.pending { background:#facc1530; color:#facc15; }
.completed { background:#22c55e30; color:#22c55e; }
</style>
</head>

<body>
<div class="container">
<h1>My Tasks</h1>

@foreach($tasks as $task)
<div class="card">
<div>
<strong>{{ $task->title }}</strong><br>
<small>{{ ucfirst($task->category) }}</small>
</div>
<span class="status {{ strtolower($task->status) }}">{{ $task->status }}</span>
</div>
@endforeach

</div>
</body>
</html>