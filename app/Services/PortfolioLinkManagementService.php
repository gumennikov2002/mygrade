<?php

namespace App\Services;

use App\Data\LinkData;
use App\Models\Link;

class PortfolioLinkManagementService
{
    public function create(LinkData $data): Link
    {
        return Link::query()->create($data->toArray());
    }

    public function update(Link $link, LinkData $data): Link
    {
        $link->update($data->toArray());

        return $link->fresh();
    }

    public function delete(Link $link): void
    {
        $link->delete();
    }
}
