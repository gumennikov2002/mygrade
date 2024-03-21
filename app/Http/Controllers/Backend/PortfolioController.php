<?php

namespace App\Http\Controllers\Backend;

use App\Data\Backend\Portfolio\PortfolioData;
use App\Data\Backend\Portfolio\SavePortfolioData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Portfolio\SavePortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function listPage(): Response
    {
        $portfolios = auth()->user()
            ->portfolios()
            ->orderBy('id', 'desc')
            ->get();

        return inertia('Backend/Portfolio/PortfolioList', [
            'portfolios' => PortfolioData::collect($portfolios),
        ]);
    }

    public function createPage(): Response
    {
        return inertia('Backend/Portfolio/PortfolioItem');
    }

    public function updatePage(Portfolio $portfolio): Response
    {
        return inertia('Backend/Portfolio/PortfolioItem', [
            'portfolio' => PortfolioData::from($portfolio),
        ]);
    }

    public function store(SavePortfolioRequest $request): RedirectResponse
    {
        auth()->user()->portfolios()->create(
            SavePortfolioData::from($request)->toArray()
        );

        return redirect()->route('portfolios.list-page');
    }

    public function update(Portfolio $portfolio, SavePortfolioRequest $request): RedirectResponse
    {
        $portfolio->update(
            SavePortfolioData::from($request)->toArray()
        );

        return redirect()->route('portfolios.update-page', [
            'portfolio' => $portfolio->id
        ]);
    }

    public function destroy(Portfolio $portfolio): void
    {
        $portfolio->delete();
    }
}
