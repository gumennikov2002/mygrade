<?php

namespace App\Http\Controllers;

use App\Contracts\PublicPortfolioService;
use App\Data\Link\LinkData;
use App\Data\Portfolio\PortfolioData;
use App\Data\Service\ServiceData;
use App\Data\User\UserData;
use App\Models\User;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response;

class PublicPortfolioController extends Controller
{
    public function __construct(
        protected PublicPortfolioService $service
    ) {}

    public function index(string $username, string $slug): InertiaResponse
    {
        $user = User::query()
            ->where('username', $username)
            ->firstOrFail();

        $portfolio = $this->service->get($user, $slug) ?? abort(Response::HTTP_NOT_FOUND);
        $services = $portfolio->services()
            ->active()
            ->orderBy('sort_order')
            ->get();
        $links = $portfolio->links()
            ->active()
            ->orderBy('sort_order')
            ->get();

        return inertia('Portfolio/PortfolioPublicItem', [
            'portfolio' => PortfolioData::from($portfolio),
            'services' => ServiceData::collect($services),
            'links' => LinkData::collect($links),
            'user' => UserData::from($user),
        ]);
    }
}
