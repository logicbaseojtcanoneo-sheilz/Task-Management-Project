<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskHub - Simplified Project Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        header {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 60px;
        }
        
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #667eea !important;
        }
        
        .navbar-brand i {
            margin-right: 10px;
        }
        
        .hero {
            text-align: center;
            color: white;
            padding: 60px 20px;
        }
        
        .hero h1 {
            font-size: 3.5em;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .hero p {
            font-size: 1.3em;
            margin-bottom: 40px;
            opacity: 0.95;
        }
        
        .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary-custom {
            background: white;
            color: #667eea;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            color: #667eea;
        }
        
        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: 2px solid white;
            cursor: pointer;
        }
        
        .btn-secondary-custom:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
        }
        
        .features {
            background: white;
            padding: 80px 20px;
            margin: 60px 0;
        }
        
        .features h2 {
            text-align: center;
            color: #333;
            margin-bottom: 50px;
            font-size: 2.5em;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid #e0e0e0;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
        }
        
        .feature-card i {
            font-size: 2.5em;
            color: #667eea;
            margin-bottom: 20px;
        }
        
        .feature-card h4 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .feature-card p {
            color: #666;
            line-height: 1.6;
        }
        
        .roles-section {
            background: #f8f9fa;
            padding: 50px 20px;
            margin: 60px 0;
        }
        
        .roles-section h2 {
            text-align: center;
            color: #333;
            margin-bottom: 50px;
            font-size: 2.5em;
        }
        
        .roles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .role-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }
        
        .role-badge i {
            font-size: 2em;
            display: block;
            margin-bottom: 10px;
        }
        
        .role-badge .role-name {
            font-weight: 600;
            font-size: 1.1em;
        }
        
        footer {
            background: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-light">
            <div class="container">
                <span class="navbar-brand">
                    <i class="fas fa-tasks"></i> TaskHub
                </span>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary" style="border-radius: 50px; padding: 8px 25px;">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary" style="border-radius: 50px; padding: 8px 25px; margin-right: 10px;">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary" style="border-radius: 50px; padding: 8px 25px;">
                                    Sign Up
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Manage Projects Effortlessly</h1>
            <p>Assign tasks to your team and track progress in real-time</p>
            
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary-custom">
                    <i class="fas fa-arrow-right"></i> Go to Dashboard
                </a>
            @else
                <div class="cta-buttons">
                    <a href="{{ route('register') }}" class="btn-primary-custom">
                        <i class="fas fa-sign-up-alt"></i> Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary-custom">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            @endauth
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Why Choose TaskHub?</h2>
            
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-users"></i>
                    <h4>Easy Collaboration</h4>
                    <p>Work seamlessly with your team. Create projects and assign tasks effortlessly.</p>
                </div>
                
                <div class="feature-card">
                    <i class="fas fa-tasks"></i>
                    <h4>Smart Assignment</h4>
                    <p>Automatically route tasks to the right team member based on category.</p>
                </div>
                
                <div class="feature-card">
                    <i class="fas fa-chart-line"></i>
                    <h4>Track Progress</h4>
                    <p>Monitor task status and project progress in real-time dashboards.</p>
                </div>
                
                <div class="feature-card">
                    <i class="fas fa-lock"></i>
                    <h4>Secure & Private</h4>
                    <p>Role-based permissions ensure only the right people see the right data.</p>
                </div>
                
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h4>Fast & Reliable</h4>
                    <p>Lightning-fast performance with 99.9% uptime guarantee.</p>
                </div>
                
                <div class="feature-card">
                    <i class="fas fa-headset"></i>
                    <h4>24/7 Support</h4>
                    <p>Our dedicated support team is always here to help you succeed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section class="roles-section">
        <div class="container">
            <h2>Our Team Structure</h2>
            
            <div class="roles-grid">
                <div class="role-badge">
                    <i class="fas fa-user-tie"></i>
                    <div class="role-name">Clients</div>
                    <small>Create & Manage</small>
                </div>
                
                <div class="role-badge">
                    <i class="fas fa-code"></i>
                    <div class="role-name">Frontend</div>
                    <small>UI/UX Tasks</small>
                </div>
                
                <div class="role-badge">
                    <i class="fas fa-database"></i>
                    <div class="role-name">Backend</div>
                    <small>Server Tasks</small>
                </div>
                
                <div class="role-badge">
                    <i class="fas fa-server"></i>
                    <div class="role-name">DevOps</div>
                    <small>Infrastructure</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2026 TaskHub. All rights reserved. | Simplified Project Management</p>
        </div>
    </footer>
</body>
</html>
