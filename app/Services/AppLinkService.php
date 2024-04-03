<?php

namespace App\Services;

use App\Contracts\LinkService;
use App\Data\Link\SaveLinkData;
use App\Models\Link;

class AppLinkService implements LinkService
{

    /**
     * Create a new link
     *
     * @param SaveLinkData $data
     *
     * @return Link
     */
    public function create(SaveLinkData $data): Link
    {
        return Link::query()->create($data->toArray());
    }

    /**
     * Update an existing link
     *
     * @param Link $link
     * @param SaveLinkData $data
     *
     * @return Link
     */
    public function update(Link $link, SaveLinkData $data): Link
    {
        $link->update($data->toArray());

        return $link->fresh();
    }

    /**
     * Delete link
     *
     * @param Link $link
     *
     * @return void
     */
    public function delete(Link $link): void
    {
        $link->delete();
    }
}
