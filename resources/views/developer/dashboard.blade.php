<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Developer Dashboard</title>
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
    margin-bottom:20px;
}
select,button {
    padding:8px;
    border-radius:8px;
    border:none;
}
button {
    background:#6366f1;
    color:white;
}
</style>
</head>

<body>
<div class="container">
<h1>Developer Tasks</h1>

@foreach($tasks as $task)
<div class="card">
<strong>{{ $task->title }}</strong>
<p>{{ $task->description }}</p>

<form method="POST" action="/tasks/{{ $task->id }}/status">
@csrf
@method('PUT')
<select name="status">
<option>Pending</option>
<option>In Progress</option>
<option>Completed</option>
</select>
<button>Update</button>
</form>
</div>
@endforeach

</div>
</body>
</html>