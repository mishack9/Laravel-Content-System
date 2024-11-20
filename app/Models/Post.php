<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_REVIEWED = 'reviewed';

    protected $fillable = [
        'title',
        'catergory_id',
        'content',
        'user_id',
        'status',
        'approval_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catergory()
    {
        return $this->belongsTo(Catergory::class);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

}
