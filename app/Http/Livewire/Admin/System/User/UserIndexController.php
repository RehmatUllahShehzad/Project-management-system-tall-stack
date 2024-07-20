<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Http\Livewire\Admin\System\SystemAbstract;
use App\Http\Livewire\Traits\ResetsPagination;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

class UserIndexController extends SystemAbstract
{
    use WithPagination, ResetsPagination;

    public string $search = '';

    public string $showTrashed = '';

    public function render(): View
    {
        return $this->view('admin.system.user.user-index-controller', function (View $view) {
            $view->with('users', $this->getUsers());
        });
    }
    
    public function getUsers(): Paginator
    {
        $query = User::query();
        
        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->showTrashed) {
            $query = $query->withTrashed();
        }

        return $query->paginate(10);
    }
}
