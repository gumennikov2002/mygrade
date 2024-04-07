<?php

namespace App\Http\Controllers;

use App\Data\LinkData;
use App\Models\Link;
use App\Models\Portfolio;
use App\Services\PortfolioLinkManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class LinkController extends Controller
{

    public function __construct(
        protected PortfolioLinkManagementService $service
    ) {}

    /**
     * @throws InvalidDataClass
     */
    public function create(Portfolio $portfolio): InertiaResponse
    {
        return inertia('Link/LinkItem', [
            'portfolio' => $portfolio->getData(),
        ]);
    }

    public function store(Portfolio $portfolio, Request $request): RedirectResponse
    {
        $link = $this->service->create(
            LinkData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $link->portfolioId
        ]);
    }

    /**
     * @throws InvalidDataClass
     */
    public function edit(Portfolio $portfolio, Link $link): InertiaResponse
    {
        return inertia('Link/LinkItem', [
            'portfolio' => $portfolio->getData(),
            'link'   => $link->getData(),
        ]);
    }

    public function update(Request $request, Portfolio $portfolio, Link $link): RedirectResponse
    {
        $this->service->update(
            $link,
            LinkData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $link->portfolioId
        ]);
    }

    public function destroy(Portfolio $portfolio, Link $link): void
    {
        $this->service->delete($link);
    }
}
