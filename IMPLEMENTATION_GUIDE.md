# Task Manager Application

A comprehensive task management system built with Laravel, featuring role-based access control for customers, frontend developers, backend developers, and server administrators.

## Overview

The Task Manager Application allows customers to create and manage tasks within their assigned projects. Tasks are automatically assigned to developers based on their category (frontend, backend, or server). Developers can then update the status of their assigned tasks.

## Key Features

### 1. **Role-Based Access Control**
   - **Customer**: Can create tasks and view their own created tasks
   - **Frontend Developer**: Can view and update frontend tasks assigned to them
   - **Backend Developer**: Can view and update backend tasks assigned to them
   - **Server Administrator**: Can view and update server tasks assigned to them

### 2. **Task Management**
   - Customers create tasks within their assigned projects
   - Automatic assignment based on task category (Frontend, Backend, Server)
   - Customers cannot see who the task is assigned to
   - Task status tracking (Pending, In Progress, Completed, Cancelled)

### 3. **Project Management**
   - Each project has one customer and developers assigned to different roles
   - 5 sample projects created with seeder
   - Developers can view all projects they're assigned to

### 4. **Secure Authentication**
   - User registration with role selection
   - Login with email and password
   - Session-based authentication
   - Middleware for role-based access control

## Database Structure

### Users Table
```
- id: Primary Key
- name: User's full name
- email: Unique email address
- password: Hashed password
- role: customer, frontend_developer, backend_developer, server_admin
- timestamps: created_at, updated_at
```

### Projects Table
```
- id: Primary Key
- name: Project name
- description: Project description
- customer_id: Foreign key to users table
- timestamps: created_at, updated_at
```

### Project Assignments Table
```
- id: Primary Key
- project_id: Foreign key to projects table
- frontend_dev_id: Foreign key to users table (frontend developer)
- backend_dev_id: Foreign key to users table (backend developer)
- server_admin_id: Foreign key to users table (server administrator)
- timestamps: created_at, updated_at
```

### Tasks Table
```
- id: Primary Key
- project_id: Foreign key to projects table
- created_by: Foreign key to users table (customer who created it)
- assigned_to: Foreign key to users table (assigned developer)
- title: Task title
- description: Task description
- category: frontend, backend, server (determines auto-assignment)
- status: pending, in_progress, completed, cancelled
- timestamps: created_at, updated_at
```

## Sample Data

The application comes with pre-seeded data:

### Developers & Administrators (6 users)
- **Frontend Developers**:
  - Alice Frontend (alice@example.com)
  - Diana Frontend (diana@example.com)
- **Backend Developers**:
  - Bob Backend (bob@example.com)
  - Edward Backend (edward@example.com)
- **Server Administrators**:
  - Charlie Server (charlie@example.com)
  - Fiona Server (fiona@example.com)

### Customers & Projects (5 projects)
- Customer 1 - Project 1 (customer1@example.com)
- Customer 2 - Project 2 (customer2@example.com)
- Customer 3 - Project 3 (customer3@example.com)
- Customer 4 - Project 4 (customer4@example.com)
- Customer 5 - Project 5 (customer5@example.com)

**All sample users have password**: `password123`

## Installation & Setup

### Prerequisites
- PHP 8.1+
- Composer
- MySQL/SQLite
- Laravel 11

### Installation Steps

1. **Clone/Navigate to the project**
```bash
cd c:\xampp\htdocs\task-manager-v2
```

2. **Install dependencies**
```bash
composer install
```

3. **Copy environment file**
```bash
cp .env.example .env
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Configure database**
Edit `.env` file with your database credentials.

6. **Run migrations**
```bash
php artisan migrate:fresh
```

7. **Seed the database**
```bash
php artisan db:seed
```

8. **Start development server**
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

## User Workflows

### Customer Workflow
1. **Register/Login**: Sign up with role "Customer" or login with existing credentials
2. **View Dashboard**: See all assigned projects
3. **Create Task**: 
   - Select a project
   - Enter task title and description
   - Select category (Frontend, Backend, or Server)
   - Task is automatically assigned to the corresponding developer
4. **View Tasks**: See only the tasks they created
5. **Delete Tasks**: Can only delete their own created tasks

### Developer Workflow
1. **Login**: Login with your developer credentials
2. **View Dashboard**: See all assigned projects and tasks
3. **View Task Details**: Click on any assigned task to view full details
4. **Update Status**: Change task status (Pending → In Progress → Completed/Cancelled)
5. **Track Progress**: Monitor all tasks assigned to you

## API Endpoints

### Authentication
- `GET /` - Home page
- `GET /login` - Login form
- `POST /login` - Submit login
- `GET /register` - Registration form
- `POST /register` - Create new account
- `POST /logout` - Logout user

### Dashboard
- `GET /dashboard` - Main dashboard (redirects based on role)

### Tasks (Customer Only)
- `GET /task/create/{projectId}` - Create task form
- `POST /task` - Store new task
- `GET /task/{id}` - View task details
- `DELETE /task/{id}` - Delete task

### Tasks (Developer Only)
- `GET /task/{id}` - View task details (assigned tasks only)
- `PUT /task/{id}/status` - Update task status

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   └── TaskController.php
│   └── Middleware/
│       └── CheckRole.php
├── Models/
│   ├── User.php
│   ├── Project.php
│   ├── ProjectAssignment.php
│   └── Task.php

database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_projects_table.php
│   ├── create_project_assignments_table.php
│   └── create_tasks_table.php
└── seeders/
    └── DatabaseSeeder.php

resources/
└── views/
    ├── welcome.blade.php
    ├── auth/
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── dashboard/
    │   ├── customer.blade.php
    │   └── developer.blade.php
    └── task/
        ├── create.blade.php
        └── show.blade.php

routes/
└── web.php
```

## Testing the Application

### Test Login Credentials

**Customer Account**:
```
Email: customer1@example.com
Password: password123
```

**Frontend Developer**:
```
Email: alice@example.com
Password: password123
```

**Backend Developer**:
```
Email: bob@example.com
Password: password123
```

**Server Administrator**:
```
Email: charlie@example.com
Password: password123
```

### Test Scenarios

1. **Customer Creates Task**:
   - Login as customer1@example.com
   - Go to dashboard
   - Click "Create Task" on Project 1
   - Enter task details and select category
   - Submit and verify task appears in list

2. **Developer Views Assigned Task**:
   - Logout and login as alice@example.com (Frontend Dev)
   - View dashboard showing assigned tasks
   - Click on task to view details
   - Update task status and verify change

3. **Role-Based Access**:
   - Try accessing /task/create without being a customer (should fail)
   - Try accessing developer routes as a customer (should fail)

## Security Features

- CSRF protection on all forms
- Middleware-based role verification
- Password hashing with bcrypt
- Authorization checks on all controller methods
- Hidden assignee information from customers
- Session-based authentication

## Middleware

### CheckRole Middleware
Located in: `app/Http/Middleware/CheckRole.php`

Registered in: `bootstrap/app.php`

Usage in routes:
```php
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Customer-only routes
});
```

## Key Business Logic

### Automatic Task Assignment
When a customer creates a task:
1. The system checks the task category
2. Retrieves the corresponding developer from project_assignments
3. Automatically assigns the task to that developer
4. Customer cannot see or select the developer

### Task Visibility
- **Customers**: See only tasks they created
- **Developers**: See only tasks assigned to them
- **Assignee field**: Hidden from customers in display views

### Project Access
- **Customers**: Can access only their own project
- **Developers**: Can access projects where they are assigned
- **Cross-project**: Cannot see tasks or projects outside their scope

## Troubleshooting

### Database Issues
- Run `php artisan migrate:fresh --seed` to reset everything
- Check database connection in `.env`

### Permission Issues
- Clear Laravel cache: `php artisan cache:clear`
- Clear config: `php artisan config:clear`
- Clear routes: `php artisan route:clear`

### Authentication Issues
- Ensure sessions table exists: Run migrations again
- Check `.env` APP_KEY is set
- Clear sessions: `php artisan session:clear`

## Future Enhancements

- Email notifications for task assignments
- Task filtering and pagination
- Task comments and activity log
- Advanced reporting and analytics
- Integration with external APIs
- Profile management for users
- Task priority levels
- Recurring tasks

## Support & Contact

For issues or questions regarding this application, please check:
- The README documentation
- Application routes in `routes/web.php`
- Controller implementations in `app/Http/Controllers/`

## License

This application is provided as-is for educational and commercial use.
