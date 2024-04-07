<?php

namespace App\Models;

use App\Traits\Scopes\ActiveScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\IgnoreProperties;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo as LiftBelongsTo;
use WendellAdriel\Lift\Lift;

/**
 * Project Model
 *
 * @property Portfolio $portfolio
 *
 * @method BelongsTo portfolio()
 * @method static BelongsTo portfolio()
 */
#[LiftBelongsTo(Portfolio::class)]
#[IgnoreProperties('mediaConversions', 'mediaCollections')]
class Project extends PortfolioItem implements HasMedia
{
    use HasFactory, Lift, InteractsWithMedia, ActiveScope;

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

    #[Config(fillable: true, column: 'sort_order', default: 1)]
    public int $sortOrder;

    #[Config(cast: 'datetime', column: 'created_at')]
    public ?Carbon $createdAt;

    #[Config(cast: 'datetime', column: 'updated_at')]
    public ?Carbon $updatedAt;

    public static function validationRules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения',
            'title.string' => 'Поле "Заголовок" должно быть строкой',
            'title.min' => 'Поле "Заголовок" должно содержать более :min символов',
            'title.max' => 'Поле "Заголовок" должно содержать не более :max символов',
        ];
    }

    public function cover(): Attribute
    {
        return Attribute::make(
            get: fn(): ?string => $this->getFirstMedia('cover')?->getUrl(),
        );
    }
}
