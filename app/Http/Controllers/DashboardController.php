<?php

namespace App\Http\Controllers;

use Inertia\Response;

class DashboardController
{
    public function __invoke(): Response
    {
        return inertia('Dashboard');
    }
}
