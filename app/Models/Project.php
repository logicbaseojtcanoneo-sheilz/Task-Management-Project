<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'customer_id',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function assignment()
    {
        return $this->hasOne(ProjectAssignment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
