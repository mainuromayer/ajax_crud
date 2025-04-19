<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Department;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'department_id'
    ];

    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
