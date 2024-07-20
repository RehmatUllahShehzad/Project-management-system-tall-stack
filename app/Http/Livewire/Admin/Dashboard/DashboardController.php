<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;

class DashboardController extends Component
{
    public function render()
    {
        return view('admin.dashboard.dashboard-controller')->layoutData([
            'title' => 'Dashboard',
        ]);
    }
}
