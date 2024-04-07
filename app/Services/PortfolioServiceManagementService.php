<?php

namespace App\Services;

use App\Data\ServiceData;
use App\Models\Service;

class PortfolioServiceManagementService
{
    public function create(ServiceData $data): Service
    {
        return Service::query()->create($data->toArray());
    }

    public function update(Service $service, ServiceData $data): Service
    {
        $service->update($data->toArray());

        return $service->fresh();
    }

    public function delete(Service $service): void
    {
        $service->delete();
    }
}
