<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artworks extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'dimension',
        'start_price',
        'price',
        'start_date',
        'end_date',
        'users_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
