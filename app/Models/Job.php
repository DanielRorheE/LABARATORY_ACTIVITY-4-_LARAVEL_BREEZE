<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $primaryKey = 'job_id';

    public $timestamps = false;

    protected $fillable = ['job_title', 'min_salary', 'max_salary'];

    protected function casts(): array
    {
        return [
            'min_salary' => 'decimal:2',
            'max_salary' => 'decimal:2',
        ];
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'job_id', 'job_id');
    }
}
