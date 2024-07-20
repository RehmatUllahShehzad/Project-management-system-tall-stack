<?php

namespace App\Traits;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

trait VerifyProjectRelationAccess
{
    public function relationProjectAccess($project_id)
    {
        $team_ids = Auth::user()->teams()->select('team_id')->pluck('team_id');

        $myProjects = Project::whereHas('teams', function ($q) use ($team_ids) {
            $q->whereIn('team_id', $team_ids);
        })->get();

        if ($myProjects->contains('id', $project_id)) {
            return true;
        }

        abort(401);
    }
}
