<?php

namespace App\Http\Controllers;

use App\Data\LinkData;
use App\Models\Link;
use App\Services\PortfolioLinkManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    public function __construct(
        protected PortfolioLinkManagementService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $link = $this->service->create(
            LinkData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $link->portfolioId
        ]);
    }

    public function update(Request $request, Link $link): RedirectResponse
    {
        $this->service->update(
            $link,
            LinkData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $link->portfolioId
        ]);
    }

    public function destroy(Link $link): void
    {
        $this->service->delete($link);
    }
}
