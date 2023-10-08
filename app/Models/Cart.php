<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artwork_id',
        'type', // Specify whether it's 'auction' or 'sale'
        'bid_id', // Add a field to store the bid ID if it's an auction item
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artwork()
    {
        return $this->belongsTo(Artworks::class, 'artwork_id');
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class, 'bid_id');
    }
    
}
