<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Task</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: Inter, sans-serif;
    background: linear-gradient(180deg,#0b1020,#060814);
    color:#e5e7eb;
}
.card {
    background:#131a33;
    padding:40px;
    border-radius:20px;
    max-width:500px;
    margin:40px auto;
}
input,textarea {
    width:100%;
    padding:14px;
    margin-top:10px;
    border-radius:12px;
    background:#020617;
    border:none;
    color:white;
}
.categories {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:10px;
    margin-top:10px;
}
.cat {
    padding:12px;
    border-radius:12px;
    background:#020617;
    text-align:center;
    cursor:pointer;
}
.cat input { display:none; }
button {
    margin-top:20px;
    width:100%;
    padding:14px;
    border:none;
    border-radius:14px;
    background:#6366f1;
    color:white;
}
</style>
</head>

<body>
<form class="card" method="POST" action="/tasks">
@csrf
<h2>Create Task</h2>

<input type="text" name="title" placeholder="Task title" required>
<textarea name="description" placeholder="Description"></textarea>

<div class="categories">
<label class="cat"><input type="radio" name="category" value="frontend" required>Frontend</label>
<label class="cat"><input type="radio" name="category" value="backend">Backend</label>
<label class="cat"><input type="radio" name="category" value="server">Server</label>
</div>

<button>Create</button>
</form>
</body>
</html>