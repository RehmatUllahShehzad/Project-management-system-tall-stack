<?php

namespace App\Models;

use App\Models\Admin\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $dates = ['created_at'];

    //has many designs
    public function designs()
    {
        return $this->hasMany(Design::class);
    }

    //project has many teams
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_projects');
    }

    //project has many users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects');
    }
}
