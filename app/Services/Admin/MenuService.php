<?php

namespace App\Services\Admin;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Exception;
use Illuminate\Support\Collection;

class MenuService
{
    public static function menu(string $name): Menu
    {
        return (new self())->get($name);
    }

    /**
     * @throws Exception
     */
    public function get(string $name): Menu
    {
        /** @var \App\Menu\Menu */
        $menu = $this->getMenuList()->where('name', $name)->first();

        if (!$menu) {
            throw new Exception("Menu Not found with name \"{$name}\"");
        }

        return $menu;
    }

    private function getMenuList(): Collection
    {
        return collect([
            /**
             * Main Sidebar Menu
             */
            Menu::make('main')
                ->addItem(function (MenuItem $item) {
                    $item->name('Dashboard')
                        ->handle('admin.dashboard')
                        // ->permission('admin:dashboard')
                        ->icon('chart-square-bar')
                        ->route('admin.dashboard');
                })
                ->addItem(function (MenuItem $item) {
                    $item->name('System')
                        ->handle('admin.system')
                        ->permission('system')
                        ->icon('cog')
                        ->route('admin.system.staff.index');
                }),

            /**
             * System Menu
             */
            Menu::make('system')
                ->addItem(function (MenuItem $item) {
                    $item->name('Staff')
                        ->handle('admin.system.staff')
                        ->route('admin.system.staff.index')
                        ->permission('system:manage-staff')
                        ->icon('identification');
                })
                ->addItem(function (MenuItem $item) {
                    $item->name('Users')
                        ->handle('admin.system.user')
                        ->route('admin.system.user.index')
                        ->permission('system:manage-role')
                        ->icon('user');
                })
                ->addItem(function (MenuItem $item) {
                    $item->name('Roles')
                        ->handle('admin.system.role')
                        ->route('admin.system.role.index')
                        ->permission('system:manage-roles')
                        ->icon('star');
                })
                ->addItem(function (MenuItem $item) {
                    $item->name('Teams')
                        ->handle('admin.system.team')
                        ->route('admin.system.team.index')
                        ->permission('system:manage-teams')
                        ->icon('users');
                }),

            /**
             * Frontend Menubar
             */
            Menu::make('frontend')
                ->addItem(function (MenuItem $item) {
                    $item->name('Dashboard')
                        ->handle('dashboard')
                        // ->permission('dashboard')
                        ->route('dashboard');
                })
                ->addItem(function (MenuItem $item) {
                    $item->name('Projects')
                        ->handle(['project', 'design', 'revision'])
                        ->permission('manage-projects')
                        ->route('project.index');
                }),
        ]);
    }
}
