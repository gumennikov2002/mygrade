<?php

namespace App\Http\Controllers\Backend;

class DashboardController
{
    public function __invoke()
    {
        return inertia('Backend/Dashboard');
    }
}
