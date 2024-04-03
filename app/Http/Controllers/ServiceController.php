<?php

namespace App\Http\Controllers;

use App\Contracts\ServiceService;
use App\Data\Service\SaveServiceData;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(
        protected ServiceService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $service = $this->service->create(
            SaveServiceData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $service->portfolioId
        ]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->service->update(
            $service,
            SaveServiceData::from($request)
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
