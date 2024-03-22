<?php

namespace App\Models;

use App\Enums\PortfolioStatusFilter;
use App\Traits\Filters\SearchFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo;
use WendellAdriel\Lift\Lift;

/**
 * Portfolio Model
 *
 * @property User $user
 *
 * @method BelongsTo user()
 * @method static BelongsTo user()
 * @method Builder filterSearch(string $search, array $columns)
 * @method static Builder filterSearch(string $search, array $columns)
 * @method Builder filterStatus(PortfolioStatusFilter $status)
 * @method static Builder filterStatus(PortfolioStatusFilter $status)
 */
#[BelongsTo(User::class)]
class Portfolio extends Model
{
    use Lift, HasFactory, SearchFilter;

    #[PrimaryKey]
    public int $id;

    #[Config(fillable: true, column: 'user_id')]
    public int $userId;

    #[Config(cast: 'boolean', fillable: true, column: 'is_active')]
    public bool $isActive;

    #[Config(fillable: true)]
    public string $slug;

    #[Config(fillable: true)]
    public string $title;

    #[Config(fillable: true)]
    public ?string $description;

    #[Config(cast: 'datetime', column: 'created_at')]
    public ?Carbon $createdAt;

    #[Config(cast: 'datetime', column: 'updated_at')]
    public ?Carbon $updatedAt;

    public function scopeFilterStatus(Builder $query, PortfolioStatusFilter $status): void
    {
        if ($status === PortfolioStatusFilter::ALL) {
            return;
        }

        $query->where('is_active', $status === PortfolioStatusFilter::ACTIVE);
    }
}
