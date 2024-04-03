<?php

namespace App\Http\Controllers;

use App\Contracts\PortfolioService;
use App\Data\Portfolio\PortfolioData;
use App\Data\Portfolio\SavePortfolioData;
use App\Data\Service\ServiceData;
use App\Enums\PortfolioFilter;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function __construct(
        protected PortfolioService $service
    ) {}

    public function index(Request $request): Response
    {
        $user = $request->user();
        $filters = $request->only(PortfolioFilter::asValuesArray());
        $portfolios = $this->service->getPaginatedByUser($user, filters: $filters);

        return inertia('Portfolio/PortfolioList', compact('portfolios', 'filters'));
    }

    public function create(): Response
    {
        return inertia('Portfolio/PortfolioItem');
    }

    public function edit(Portfolio $portfolio): Response
    {
        Gate::authorize('update', $portfolio);

        $services = ServiceData::collect(
            $portfolio->services()
                ->orderBy('sort_order')
                ->get()
        );
        $portfolio = PortfolioData::from($portfolio);

        return inertia('Portfolio/PortfolioItem', compact('portfolio', 'services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->service->create(
            $request->user(),
            SavePortfolioData::from($request)
        );

        return redirect()->route('portfolios.index');
    }

    public function update(Portfolio $portfolio, Request $request): RedirectResponse
    {
        $this->service->update(
            $portfolio,
            SavePortfolioData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $portfolio->id
        ]);
    }

    public function destroy(Portfolio $portfolio): void
    {
        $this->service->delete($portfolio);
    }
}
