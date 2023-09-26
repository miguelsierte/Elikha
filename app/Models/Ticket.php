<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
    'title',
    'description',
    'users_id',
    'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
