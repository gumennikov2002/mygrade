<?php

namespace App\Contracts;

use App\Data\Link\SaveLinkData;
use App\Models\Link;

interface LinkService
{
    /**
     * Create a new link
     *
     * @param SaveLinkData $data
     *
     * @return Link
     */
    public function create(SaveLinkData $data): Link;

    /**
     * Update an existing link
     *
     * @param Link $link
     * @param SaveLinkData $data
     *
     * @return Link
     */
    public function update(Link $link, SaveLinkData $data): Link;

    /**
     * Delete link
     *
     * @param Link $link
     *
     * @return void
     */
    public function delete(Link $link): void;
}
