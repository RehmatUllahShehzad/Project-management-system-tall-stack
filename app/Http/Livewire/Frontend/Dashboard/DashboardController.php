<?php

namespace App\Http\Livewire\Frontend\Dashboard;

use App\View\Components\Frontend\Layouts\MasterLayout;
use Livewire\Component;

class DashboardController extends Component
{
    public function render()
    {
        return view('frontend.dashboard.dashboard-controller')
            ->layout(MasterLayout::class)
            ->layoutData([
                'title' => 'Dashboard',
            ]);
    }
}
