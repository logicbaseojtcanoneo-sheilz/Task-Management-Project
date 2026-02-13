<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'frontend_dev_id',
        'backend_dev_id',
        'server_admin_id',
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function frontendDeveloper()
    {
        return $this->belongsTo(User::class, 'frontend_dev_id');
    }

    public function backendDeveloper()
    {
        return $this->belongsTo(User::class, 'backend_dev_id');
    }

    public function serverAdmin()
    {
        return $this->belongsTo(User::class, 'server_admin_id');
    }
}
