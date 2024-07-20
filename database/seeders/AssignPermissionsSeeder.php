<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin Role
        $adminRole = Role::firstOrCreate([
            'name' => 'SuperAdmin',
            'guard_name' => 'admin'
        ]);

        $adminPermissions = Permission::where('guard_name', 'admin')->pluck('id', 'id')->all();
        $adminRole->syncPermissions($adminPermissions);

        //user Role
        $userRole = Role::firstOrCreate([
            'name' => 'User',
            'guard_name' => 'web'
        ]);

        //DL Role
        $DlRole = Role::firstOrCreate([
            'name' => 'DL',
            'guard_name' => 'web'
        ]);

        //TD Role
        $TdRole = Role::firstOrCreate([
            'name' => 'TD',
            'guard_name' => 'web'
        ]);

        //client permissions
        $userPermissions = Permission::where([
            ['guard_name', 'web'], 
            ['name', '!=', 'view-unapproved-comments'], 
            ['name', '!=', 'create-projects'],
            ['name', '!=', 'delete-others-comments']
        ])
        ->pluck('id', 'id')
        ->all();
        
        $userRole->syncPermissions($userPermissions);

        //DL permissions
        $DlPermissions = Permission::where('guard_name', 'web')
            ->pluck('id', 'id')
            ->all();

        $DlRole->syncPermissions($DlPermissions);

        //TD permissions
        $TdPermissions = Permission::where([
            ['guard_name', 'web'], 
            ['name', '!=', 'approve-comments'],
            ['name', '!=', 'delete-others-comments']
            ])
            ->pluck('id', 'id')
            ->all();

        $TdRole->syncPermissions($TdPermissions);
    }
}
