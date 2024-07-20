<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'revision_id',
        'x',
        'y',
    ];

    protected $casts = [
        'x' => 'float',
        'y' => 'float',
    ];


    public function revision()
    {
        return $this->belongsTo(Revision::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //get approved comments
    public function approved_comments()
    {
        return $this->comments()->where('is_approved', true);
    }
}
