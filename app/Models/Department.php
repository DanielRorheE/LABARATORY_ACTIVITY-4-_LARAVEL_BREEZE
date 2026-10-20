<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $primaryKey = 'department_id';

    public $timestamps = false;

    protected $fillable = ['department_name', 'location_id'];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id', 'department_id');
    }
}
