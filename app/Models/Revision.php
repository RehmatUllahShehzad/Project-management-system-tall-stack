<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Revision extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'design_id',
    ];

    public function design()
    {
        return $this->belongsTo(Design::class);
    }

    //has many feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
