<?php

namespace App\Models;
use App\Models\Artworks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = ['Category'];
    
    public function artworks()
    {
        return $this->hasMany(Artworks::class);
    }
}
