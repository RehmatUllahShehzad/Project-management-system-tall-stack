<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id', 'email', 'token',
    ];

    //belongs to a team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
