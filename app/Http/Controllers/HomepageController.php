<?php

namespace App\Http\Controllers;

use Inertia\Response;

class HomepageController extends Controller
{
    public function __invoke(): Response
    {
        return inertia('Homepage');
    }
}
