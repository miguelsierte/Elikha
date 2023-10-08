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
        'remarks',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

   

    public function bids()
    {
        return $this->hasMany(Bid::class, 'artwork_id');
    }
    
    public function getLeadBidAttribute()
    {
        return $this->bids->max('amount');
    }
    
    
}
