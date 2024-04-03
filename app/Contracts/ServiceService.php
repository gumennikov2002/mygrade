<?php

namespace App\Contracts;

use App\Data\Service\SaveServiceData;
use App\Models\Service;

interface ServiceService
{
    /**
     * Create a new service
     *
     * @param SaveServiceData $data
     *
     * @return mixed
     */
    public function create(SaveServiceData $data): Service;

    /**
     * Update an existing service
     *
     * @param Service $service
     * @param SaveServiceData $data
     *
     * @return Service
     */
    public function update(Service $service, SaveServiceData $data): Service;

    /**
     * Delete service
     *
     * @param Service $service
     *
     * @return void
     */
    public function delete(Service $service): void;
}
