<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Response;

class HomepageController extends Controller
{
    public function __invoke(): Response
    {
        return inertia('Frontend/Homepage');
    }
}
