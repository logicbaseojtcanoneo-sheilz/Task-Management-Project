<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: Inter, sans-serif;
    background: linear-gradient(180deg,#0b1020,#060814);
    color:#e5e7eb;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.card {
    background:#131a33;
    padding:40px;
    border-radius:20px;
    width:100%;
    max-width:380px;
}
input,button {
    width:100%;
    padding:14px;
    margin-top:12px;
    border-radius:12px;
    border:none;
}
input {
    background:#020617;
    color:white;
}
button {
    background:#6366f1;
    color:white;
    font-weight:600;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="card">
    <h2>Login</h2>
    <input type="email" placeholder="Email">
    <input type="password" placeholder="Password">
    
    <!-- Fake login: redirects to dashboard -->
    <button onclick="window.location.href='/dashboard'">
        Login
    </button>
</div>

</body>
</html>