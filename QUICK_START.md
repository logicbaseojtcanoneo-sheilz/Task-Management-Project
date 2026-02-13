# Quick Start Guide - Task Manager Application

## 🚀 Getting Started in 5 Minutes

### Step 1: Verify Installation
Make sure Laravel is running:
```bash
cd c:\xampp\htdocs\task-manager-v2
php artisan serve
```

The app should be available at `http://127.0.0.1:8000`

### Step 2: Login with Sample Account

Visit `http://127.0.0.1:8000` and click **Login**.

**Try this customer account:**
```
Email: customer1@example.com
Password: password123
```

### Step 3: Create Your First Task

1. After logging in, click the **"Create Task"** button on Project 1
2. Fill in the task details:
   - Title: "Design new homepage"
   - Description: "Create a modern homepage design"
   - Category: **Frontend** (this auto-assigns to Alice, the frontend developer)
3. Click **"Create Task"**

### Step 4: View Task as Developer

1. Logout (click the logout button)
2. Login as the frontend developer:
```
Email: alice@example.com
Password: password123
```

3. You'll see the task you just created on your dashboard
4. Click on the task to view details
5. Change the status from "Pending" to "In Progress"

### Step 5: Go Back to Customer View

1. Logout and login again as customer1@example.com
2. View your task - it now shows "In Progress" status
3. Notice: **You cannot see who it was assigned to** (this is intentional for security)

---

## 📋 Test All Roles

### As a Customer:
- ✅ Create tasks
- ✅ View only your created tasks
- ✅ Select task category (Frontend/Backend/Server)
- ✅ Delete your tasks
- ❌ Cannot see assignee
- ❌ Cannot update task status

### As Frontend Developer (Alice):
- ✅ View assigned frontend tasks
- ✅ Update task status
- ✅ View project information
- ✅ See who created the task
- ❌ Cannot create tasks
- ❌ Cannot delete tasks

### As Backend Developer (Bob):
- ✅ View assigned backend tasks (try creating a "Backend" category task)
- ✅ Update task status
- ✅ View project information
- ❌ Cannot see frontend tasks
- ❌ Cannot create tasks

### As Server Admin (Charlie):
- ✅ View assigned server tasks (try creating a "Server" category task)
- ✅ Update task status
- ✅ View project information
- ❌ Cannot see other types of tasks
- ❌ Cannot create tasks

---

## 🔑 All Sample Accounts

| Role | Email | Password |
|------|-------|----------|
| Customer 1 | customer1@example.com | password123 |
| Customer 2 | customer2@example.com | password123 |
| Customer 3 | customer3@example.com | password123 |
| Customer 4 | customer4@example.com | password123 |
| Customer 5 | customer5@example.com | password123 |
| Frontend Dev 1 | alice@example.com | password123 |
| Frontend Dev 2 | diana@example.com | password123 |
| Backend Dev 1 | bob@example.com | password123 |
| Backend Dev 2 | edward@example.com | password123 |
| Server Admin 1 | charlie@example.com | password123 |
| Server Admin 2 | fiona@example.com | password123 |

---

## 💡 How the System Works

### Task Creation Flow:

```
Customer 1 creates a task
         ↓
Task Category Selected (Frontend/Backend/Server)
         ↓
System Looks Up Project Assignment
         ↓
Task Automatically Assigned to Developer
         ↓
Developer Receives Task on Dashboard
         ↓
Developer Updates Status
         ↓
Customer Sees Status Change (but not who it's assigned to)
```

### Example Scenario:

1. **Customer 1** creates a task "Build Login API" with category **Backend**
2. System automatically assigns it to **Bob (Backend Developer)**
3. **Bob** logs in and sees the task
4. **Bob** changes status to "In Progress"
5. **Customer 1** logs in and sees status is "In Progress"
6. **Alice** (Frontend Dev) cannot see this task - it's only for Backend developers

---

## 🛠️ Common Tasks

### Create New User Account
1. Click "Sign Up" on the login page
2. Fill in name, email, password
3. Select role (Customer, Frontend Dev, Backend Dev, Server Admin)
4. Click "Create Account"
5. You're automatically logged in

### Reset Database
If you want a fresh start:
```bash
php artisan migrate:fresh --seed
```

### View Database Directly
```bash
php artisan tinker

# Check all users
User::all();

# Check all tasks
Task::all();

# Check projects
Project::all();
```

---

## 🎯 Key Business Rules

1. **Only Customers can create tasks** - under their assigned projects
2. **Category determines assignment** - Frontend → Alice/Diana, Backend → Bob/Edward, Server → Charlie/Fiona
3. **Customers can't see assignee** - for privacy
4. **Developers can only see their tasks** - can't cross-view other roles' tasks
5. **Task deletion** - only the customer who created it can delete
6. **Status updates** - only the assigned developer can update

---

## 📞 Troubleshooting

### Page shows blank / Error?
- Check the Laravel server is running
- Try: `php artisan cache:clear`
- Try: `php artisan config:clear`

### Database issues?
- Reset with: `php artisan migrate:fresh --seed`

### Can't login?
- Check email and password are correct
- Both are case-sensitive
- All sample accounts use: `password123`

### Task not appearing?
- Refresh the page
- Try logging out and back in
- Check you're viewing the right role's dashboard

---

## 📚 Learn More

For detailed documentation, see:
- `IMPLEMENTATION_GUIDE.md` - Full technical documentation
- `README.md` - Original project README
- `routes/web.php` - All available routes

---

## ✨ Highlights

✅ Complete task management system
✅ Role-based security
✅ Automatic task routing
✅ Beautiful Bootstrap UI
✅ 5 pre-configured projects
✅ All roles tested and ready
✅ Production-ready code

**Happy task managing!** 🎉
