<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'status',
        'user_id',
        'deadline',
        'priority',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
