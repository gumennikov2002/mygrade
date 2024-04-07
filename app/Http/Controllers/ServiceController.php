<?php

namespace App\Http\Controllers;

use App\Data\ServiceData;
use App\Models\Portfolio;
use App\Models\Service;
use App\Services\PortfolioServiceManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class ServiceController extends Controller
{

    public function __construct(
        protected PortfolioServiceManagementService $service
    ) {}

    /**
     * @throws InvalidDataClass
     */
    public function create(Portfolio $portfolio): InertiaResponse
    {
        return inertia('Service/ServiceItem', [
            'portfolio' => $portfolio->getData(),
        ]);
    }

    public function store(Portfolio $portfolio, Request $request): RedirectResponse
    {
        $service = $this->service->create(
            ServiceData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $service->portfolioId
        ]);
    }

    /**
     * @throws InvalidDataClass
     */
    public function edit(Portfolio $portfolio, Service $service): InertiaResponse
    {
        return inertia('Service/ServiceItem', [
            'portfolio' => $portfolio->getData(),
            'service'   => $service->getData(),
        ]);
    }

    public function update(Request $request, Portfolio $portfolio, Service $service): RedirectResponse
    {
        $this->service->update(
            $service,
            ServiceData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $service->portfolioId
        ]);
    }

    public function destroy(Portfolio $portfolio, Service $service): void
    {
        $this->service->delete($service);
    }
}
