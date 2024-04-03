<?php

namespace App\Services;

use App\Contracts\ServiceService;
use App\Data\Service\SaveServiceData;
use App\Models\Service;

class AppServiceService implements ServiceService
{

    /**
     * Create a new service
     *
     * @param SaveServiceData $data
     *
     * @return mixed
     */
    public function create(SaveServiceData $data): Service
    {
        return Service::query()->create($data->toArray());
    }

    /**
     * Update an existing service
     *
     * @param Service $service
     * @param SaveServiceData $data
     *
     * @return Service
     */
    public function update(Service $service, SaveServiceData $data): Service
    {
        $service->update($data->toArray());

        return $service->fresh();
    }

    /**
     * Delete service
     *
     * @param Service $service
     *
     * @return void
     */
    public function delete(Service $service): void
    {
        $service->delete();
    }
}
