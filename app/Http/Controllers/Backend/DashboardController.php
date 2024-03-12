<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;

class DashboardController
{
    public function __invoke()
    {
        return Inertia::render('Backend/Dashboard');
    }
}
