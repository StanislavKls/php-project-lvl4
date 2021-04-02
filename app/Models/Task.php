<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\Label;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class);
    }
    public function labels()
    {
        return $this->belongsToMany(Label::class, 'task_label', 'task_id', 'label_id');
    }
}
