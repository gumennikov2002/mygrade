<?php

namespace App\Http\Controllers;

use App\Contracts\LinkService;
use App\Data\Link\SaveLinkData;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    public function __construct(
        protected LinkService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $link = $this->service->create(
            SaveLinkData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $link->portfolioId
        ]);
    }

    public function update(Request $request, Link $link): RedirectResponse
    {
        $this->service->update(
            $link,
            SaveLinkData::from($request)
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
