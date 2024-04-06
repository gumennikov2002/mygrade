<?php

namespace App\Http\Controllers;

use App\Contracts\PortfolioService;
use App\Data\LinkData;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    public function __construct(
        protected PortfolioService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $link = $this->service->newLink(
            LinkData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $link->portfolioId
        ]);
    }

    public function update(Request $request, Link $link): RedirectResponse
    {
        $this->service->updateLink(
            $link,
            LinkData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $link->portfolioId
        ]);
    }

    public function destroy(Link $link): void
    {
        $this->service->deleteLink($link);
    }
}
