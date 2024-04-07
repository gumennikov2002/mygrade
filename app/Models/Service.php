<?php

namespace App\Models;

use App\Data\ServiceData;
use App\Traits\Scopes\ActiveScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo as LiftBelongsTo;
use WendellAdriel\Lift\Lift;


/**
 * Service Model
 *
 * @property Portfolio $portfolio
 *
 * @method BelongsTo portfolio()
 * @method static BelongsTo portfolio()
 */
#[LiftBelongsTo(Portfolio::class)]
class Service extends PortfolioItem
{
    use HasFactory, Lift, ActiveScope, WithData;

    #[PrimaryKey]
    public int $id;

    #[Config(fillable: true, column: 'portfolio_id')]
    public int $portfolioId;

    #[Config(cast: 'boolean', fillable: true, column: 'is_active')]
    public bool $isActive;

    #[Config(fillable: true)]
    public string $title;

    #[Config(fillable: true)]
    public ?string $description;

    #[Config(cast: 'float', fillable: true)]
    public float $price;

    #[Config(fillable: true, column: 'sort_order', default: 1)]
    public int $sortOrder;

    #[Config(cast: 'boolean', fillable: true, column: 'is_final_price')]
    public bool $isFinalPrice;

    #[Config(cast: 'datetime', column: 'created_at')]
    public ?Carbon $createdAt;

    #[Config(cast: 'datetime', column: 'updated_at')]
    public ?Carbon $updatedAt;

    protected string $dataClass = ServiceData::class;

    public static function validationRules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения',
            'title.string' => 'Поле "Заголовок" должно быть строкой',
            'title.min' => 'Поле "Заголовок" должно содержать более :min символов',
            'title.max' => 'Поле "Заголовок" должно содержать не более :max символов',
            'price.required' => 'Поле "Цена" обязательно для заполнения',
            'price.numeric' => 'Поле "Цена" должно быть числом'
        ];
    }
}
