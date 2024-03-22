<?php

namespace App\Http\Controllers;

use App\Contracts\PortfolioService;
use App\Data\Portfolio\PortfolioData;
use App\Data\Portfolio\SavePortfolioData;
use App\Enums\PortfolioFilter;
use App\Http\Requests\Portfolio\SavePortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function __construct(
        protected PortfolioService $service
    ) {}

    public function listPage(Request $request): Response
    {
        $user = $request->user();
        $filters = $request->only(PortfolioFilter::unpackValues());
        $portfolios = $this->service->getPaginatedByUser($user, filters: $filters);

        return inertia('Portfolio/PortfolioList', compact('portfolios', 'filters'));
    }

    public function createPage(): Response
    {
        return inertia('Portfolio/PortfolioItem');
    }

    public function updatePage(Portfolio $portfolio): Response
    {
        return inertia('Portfolio/PortfolioItem', [
            'portfolio' => PortfolioData::from($portfolio),
        ]);
    }

    public function store(SavePortfolioRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->user(),
            SavePortfolioData::from($request)
        );

        return redirect()->route('portfolios.list-page');
    }

    public function update(Portfolio $portfolio, SavePortfolioRequest $request): RedirectResponse
    {
        $this->service->update(
            $portfolio,
            SavePortfolioData::from($request)
        );

        return redirect()->route('portfolios.update-page', [
            'portfolio' => $portfolio->id
        ]);
    }

    public function destroy(Portfolio $portfolio): void
    {
        $this->service->delete($portfolio);
    }
}
