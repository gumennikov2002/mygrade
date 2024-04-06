<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class PortfolioItem extends Model
{
    public static function boot(): void
    {
        parent::boot();

        static::creating(function(self $item) {
            self::setOrderBeforeCreate($item);
        });

        static::updating(function(self $item) {
            self::setOrderBeforeUpdate($item);
        });

        static::deleted(function(self $item) {
            self::setOrderAfterDelete($item);
        });
    }

    private static function setOrderBeforeCreate(self $item): void
    {
        $lastOrder = static::query()
            ->where('portfolio_id', $item->portfolioId)
            ->max('sort_order');

        $item->sort_order = $lastOrder + 1;
    }

    private static function setOrderBeforeUpdate(self $item): void
    {
        $newOrder = $item->sortOrder;
        $currentOrder = $item->getOriginal('sort_order');

        $maxOrder = static::query()
            ->where('portfolio_id', $item->portfolioId)
            ->max('sort_order');

        $item->sort_order = max(1, min($newOrder, $maxOrder));

        if ($newOrder != $currentOrder) {
            $query = static::query()->where('portfolio_id', $item->portfolioId);

            if ($newOrder > $currentOrder) {
                $query->whereBetween('sort_order', [$currentOrder + 1, $newOrder]);
                $query->decrement('sort_order');
            } else {
                $query->whereBetween('sort_order', [$newOrder, $currentOrder - 1]);
                $query->increment('sort_order');
            }
        }
    }

    private static function setOrderAfterDelete(self $item): void
    {
        static::query()
            ->where('portfolio_id', $item->portfolioId)
            ->where('sort_order', '>', $item->sortOrder)
            ->decrement('sort_order');
    }
}
