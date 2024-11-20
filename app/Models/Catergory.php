<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catergory extends Model
{
    use HasFactory;
    use Sluggable;




    protected $fillable = [
        'name',
        'status',
        'slug'
    ];


   public function sluggable(): array
   {
    return [
        'slug' => [
            'source' => 'status'
        ]
        ];
   }


   public function posts()
   {
    return $this->hasMany(Post::class);
   }

    
}
