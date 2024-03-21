<?php

namespace App\Http\Controllers;

use App\Contracts\PortfolioService;
use App\Data\Portfolio\PortfolioData;
use App\Data\Portfolio\SavePortfolioData;
use App\Http\Requests\Portfolio\SavePortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function __construct(
        protected PortfolioService $service
    ) {}

    public function listPage(): Response
    {
        $portfolios = auth()->user()
            ->portfolios()
            ->orderBy('id', 'desc')
            ->get();

        return inertia('Portfolio/PortfolioList', [
            'portfolios' => PortfolioData::collect($portfolios),
        ]);
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
