<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'feedback_id',
        'comment',
        'is_approved',
    ];

    //belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //belongs to a feedback
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
