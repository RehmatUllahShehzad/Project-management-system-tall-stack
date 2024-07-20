<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'status'
    ];

    protected $dates = ['created_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    //has many revisions
    public function revisions()
    {
        return $this->hasMany(Revision::class);
    }

    public function latestRevision()
    {
        return $this->hasOne(Revision::class)->latest();
    }
}
