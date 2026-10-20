<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $primaryKey = 'employee_id';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'hire_date',
        'job_id',
        'salary',
        'manager_id',
        'department_id',
    ];

    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
            'salary' => 'decimal:2',
        ];
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(self::class, 'manager_id', 'employee_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(self::class, 'manager_id', 'employee_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    public function dependents(): HasMany
    {
        return $this->hasMany(Dependent::class, 'employee_id', 'employee_id');
    }
}
