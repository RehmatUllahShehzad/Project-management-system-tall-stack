<?php

namespace App\Http\Livewire\Admin\System\Role;

use App\Http\Livewire\Admin\System\SystemAbstract;
use App\Http\Livewire\Traits\Notifies;
use Spatie\Permission\Models\Role;

abstract class RoleAbstract extends SystemAbstract
{
    use Notifies;

    public Role $role;
}
