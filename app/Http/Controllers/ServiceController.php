<?php

namespace App\Http\Controllers;

use App\Data\ServiceData;
use App\Models\Service;
use App\Services\PortfolioServiceManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(
        protected PortfolioServiceManagementService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $service = $this->service->create(
            ServiceData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $service->portfolioId
        ]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->service->update(
            $service,
            ServiceData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $service->portfolioId
        ]);
    }

    public function destroy(Service $service): void
    {
        $this->service->delete($service);
    }
}
