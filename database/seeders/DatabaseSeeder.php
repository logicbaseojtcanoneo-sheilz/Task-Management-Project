<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create developers and admins first
        $frontendDev1 = User::create([
            'name' => 'Alice Frontend',
            'email' => 'alice@example.com',
            'password' => Hash::make('password123'),
            'role' => 'frontend_developer',
        ]);

        $backendDev1 = User::create([
            'name' => 'Bob Backend',
            'email' => 'bob@example.com',
            'password' => Hash::make('password123'),
            'role' => 'backend_developer',
        ]);

        $serverAdmin1 = User::create([
            'name' => 'Charlie Server',
            'email' => 'charlie@example.com',
            'password' => Hash::make('password123'),
            'role' => 'server_admin',
        ]);

        $frontendDev2 = User::create([
            'name' => 'Diana Frontend',
            'email' => 'diana@example.com',
            'password' => Hash::make('password123'),
            'role' => 'frontend_developer',
        ]);

        $backendDev2 = User::create([
            'name' => 'Edward Backend',
            'email' => 'edward@example.com',
            'password' => Hash::make('password123'),
            'role' => 'backend_developer',
        ]);

        $serverAdmin2 = User::create([
            'name' => 'Fiona Server',
            'email' => 'fiona@example.com',
            'password' => Hash::make('password123'),
            'role' => 'server_admin',
        ]);

        // Create customers and projects
        $projects = [];
        $customers = [];
        
        $customerNames = [
            ['John Anderson', 'john@example.com'],
            ['Sarah Williams', 'sarah@example.com'],
            ['Michael Davis', 'michael@example.com'],
            ['Emma Martinez', 'emma@example.com'],
            ['James Wilson', 'james@example.com'],
        ];

        for ($i = 0; $i < 5; $i++) {
            $customer = User::create([
                'name' => $customerNames[$i][0],
                'email' => $customerNames[$i][1],
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]);
            $customers[] = $customer;

            // Assign developers in round-robin fashion
            $frontendDev = ($i % 2 === 0) ? $frontendDev1 : $frontendDev2;
            $backendDev = ($i % 2 === 0) ? $backendDev1 : $backendDev2;
            $serverAdmin = ($i % 2 === 0) ? $serverAdmin1 : $serverAdmin2;

            $project = Project::create([
                'name' => $customerNames[$i][0] . "'s Project",
                'description' => "Project for " . $customerNames[$i][0],
                'customer_id' => $customer->id,
            ]);
            $projects[] = $project;

            // Create project assignment
            ProjectAssignment::create([
                'project_id' => $project->id,
                'frontend_dev_id' => $frontendDev->id,
                'backend_dev_id' => $backendDev->id,
                'server_admin_id' => $serverAdmin->id,
            ]);
        }
    }
}
