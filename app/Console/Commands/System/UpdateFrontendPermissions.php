<?php

namespace App\Console\Commands\System;

use App\Services\Frontend\PermissionProviderService;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class UpdateFrontendPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:update-frontend-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Permissions for frontend from configuration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Updating Frontend Permissions');
        PermissionProviderService::make()->registerAllPermissions();

        /** @var \Spatie\Permission\Models\Role */
        $role = Role::findOrCreate('User', 'web');
        $role = Role::findOrCreate('DL', 'web');
        $role = Role::findOrCreate('TD', 'web');
        $role->save();

        $this->info('Permissions Frontend Updated');

        return 0;
    }
}
