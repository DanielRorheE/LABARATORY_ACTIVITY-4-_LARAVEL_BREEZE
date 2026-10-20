<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dependent extends Model
{
    protected $primaryKey = 'dependent_id';

    public $timestamps = false;

    protected $fillable = ['first_name', 'last_name', 'relationship', 'employee_id'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
