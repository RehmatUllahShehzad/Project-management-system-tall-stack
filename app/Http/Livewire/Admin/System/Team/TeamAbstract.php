<?php

namespace App\Http\Livewire\Admin\System\Team;

use App\Http\Livewire\Admin\System\SystemAbstract;
use App\Http\Livewire\Traits\Notifies;
use App\Models\Admin\Team;

abstract class TeamAbstract extends SystemAbstract
{
    use Notifies;

    public Team $team;
}
