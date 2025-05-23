<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
        'deadline',
        'immunity_id',
    ];

    protected $casts = [
        'deadline' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
