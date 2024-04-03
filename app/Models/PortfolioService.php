<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo as LiftBelongsTo;
use WendellAdriel\Lift\Lift;

/**
 * PortfolioService Model
 *
 * @property Service $service
 * @property Portfolio $portfolio
 *
 * @method BelongsTo service()
 * @method static BelongsTo service()
 * @method BelongsTo portfolio()
 * @method static BelongsTo portfolio()
 */
#[LiftBelongsTo(Service::class)]
#[LiftBelongsTo(Portfolio::class)]
class PortfolioService extends Model
{
    use HasFactory, Lift;

    #[PrimaryKey]
    public int $id;

    #[Config(fillable: true, column: 'portfolio_id')]
    public int $portfolioId;

    #[Config(fillable: true, column: 'service_id')]
    public int $serviceId;

    #[Config(cast: 'float', fillable: true)]
    public float $price;

    #[Config(cast: 'boolean', fillable: true, column: 'is_start_price')]
    public bool $isStartPrice;

    #[Config(cast: 'datetime', column: 'created_at')]
    public ?Carbon $createdAt;

    #[Config(cast: 'datetime', column: 'updated_at')]
    public ?Carbon $updatedAt;
}
