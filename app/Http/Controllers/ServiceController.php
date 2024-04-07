<?php

namespace App\Http\Controllers;

use App\Data\ServiceData;
use App\Models\Service;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(
        protected PortfolioService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $service = $this->service->newService(
            ServiceData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $service->portfolioId
        ]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->service->updateService(
            $service,
            ServiceData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $service->portfolioId
        ]);
    }

    public function destroy(Service $service): void
    {
        $this->service->deleteService($service);
    }
}
