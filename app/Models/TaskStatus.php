<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function task(): hasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
