<?php

namespace App\Models;

use App\Traits\Filters\LinkFilters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo as LiftBelongsTo;
use WendellAdriel\Lift\Lift;

/**
 * Link Model
 *
 * @property Portfolio $portfolio
 *
 * @method BelongsTo portfolio()
 * @method static BelongsTo portfolio()
 */
#[LiftBelongsTo(Portfolio::class)]
class Link extends Model
{
    use HasFactory, Lift, LinkFilters;

    #[PrimaryKey]
    public int $id;

    #[Config(fillable: true, column: 'portfolio_id')]
    public int $portfolioId;

    #[Config(cast: 'boolean', fillable: true, column: 'is_active')]
    public bool $isActive;

    #[Config(fillable: true)]
    public string $label;

    #[Config(fillable: true)]
    public string $href;

    #[Config(fillable: true, column: 'sort_order', default: 1)]
    public ?int $sortOrder;

    #[Config(cast: 'datetime', column: 'created_at')]
    public ?Carbon $createdAt;

    #[Config(cast: 'datetime', column: 'updated_at')]
    public ?Carbon $updatedAt;

    public static function validationRules(): array
    {
        return [
            'label' => ['required', 'string', 'min:1', 'max:255'],
            'href' => ['required', 'url'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'label.required' => 'Поле "Название" обязательно для заполнения',
            'label.string' => 'Поле "Название" должно быть строкой',
            'label.min' => 'Поле "Название" должно содержать более :min символов',
            'label.max' => 'Поле "Название" должно содержать не более :max символов',
            'href.required' => 'Поле "Ссылка" обязательно для заполнения',
            'href.url' => 'Поле "Ссылка" должно быть ссылкой',
        ];
    }

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
        $lastOrder = self::query()
            ->where('portfolio_id', $item->portfolioId)
            ->max('sort_order');

        $item->sort_order = $lastOrder + 1;
    }

    private static function setOrderBeforeUpdate(self $item): void
    {
        $newOrder = $item->sortOrder;
        $currentOrder = $item->getOriginal('sort_order');

        $maxOrder = self::query()
            ->where('portfolio_id', $item->portfolioId)
            ->max('sort_order');

        $item->sort_order = max(1, min($newOrder, $maxOrder));

        if ($newOrder != $currentOrder) {
            $query = self::query()->where('portfolio_id', $item->portfolioId);

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
        self::query()
            ->where('portfolio_id', $item->portfolioId)
            ->where('sort_order', '>', $item->sortOrder)
            ->decrement('sort_order');
    }
}
