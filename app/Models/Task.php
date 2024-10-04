<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'status','created_on', 'assigned_to', 'created_by'
    ];

    // Relationship: The user this task is assigned to
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relationship: The admin who created this task
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
