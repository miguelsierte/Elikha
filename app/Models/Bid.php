<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    // ...

    public function artwork()
    {
        return $this->belongsTo(Artworks::class, 'artwork_id');
        
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
