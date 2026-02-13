<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container-home {
            background: white;
            padding: 60px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 600px;
        }
        .container-home h1 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 3em;
        }
        .container-home p {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        .features {
            margin: 40px 0;
            text-align: left;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        .features ul {
            list-style: none;
            padding: 0;
        }
        .features li {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .features li:last-child {
            border-bottom: none;
        }
        .features i {
            color: #667eea;
            margin-right: 10px;
        }
        .btn-home {
            padding: 12px 30px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1em;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            text-decoration: none;
        }
        .btn-signup {
            background: #f0f0f0;
            color: #667eea;
        }
        .btn-signup:hover {
            background: #e0e0e0;
            text-decoration: none;
        }
        .role-badges {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .badge-role {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container-home">
        <h1><i class="fas fa-tasks"></i> Task Manager</h1>
        <p>Manage your projects and tasks efficiently with role-based access control</p>

        @if (Auth::check())
            <div class="alert alert-info">
                <p>Welcome back, <strong>{{ Auth::user()->name }}</strong>!</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-home btn-login" style="font-size: 1.1em;">
                <i class="fas fa-arrow-right"></i> Go to Dashboard
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-home btn-signup" style="font-size: 1.1em;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        @else
            <div class="role-badges">
                <span class="badge-role"><i class="fas fa-user"></i> Customer</span>
                <span class="badge-role"><i class="fas fa-code"></i> Frontend Dev</span>
                <span class="badge-role"><i class="fas fa-database"></i> Backend Dev</span>
                <span class="badge-role"><i class="fas fa-server"></i> Server Admin</span>
            </div>

            <div class="features">
                <h5>Key Features</h5>
                <ul>
                    <li><i class="fas fa-check-circle"></i> Create and manage tasks within projects</li>
                    <li><i class="fas fa-check-circle"></i> Automatic task assignment based on category</li>
                    <li><i class="fas fa-check-circle"></i> Real-time status updates</li>
                    <li><i class="fas fa-check-circle"></i> Role-based access control</li>
                    <li><i class="fas fa-check-circle"></i> Secure and user-friendly interface</li>
                </ul>
            </div>

            <div>
                <a href="{{ route('login') }}" class="btn btn-home btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-home btn-signup">
                    <i class="fas fa-user-plus"></i> Sign Up
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
