<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\auth;


class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        if (Auth::user()->roles[0]->name == 'Admin') {
            return view('layouts.LOadmin.app');
        } else if (Auth::user()->roles[0]->name == 'User') {
            return view('layouts.LOusers.app');
        } else {
            return view('layouts.app');
        }


    }
}
