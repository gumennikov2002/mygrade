<?php

namespace App\Models;

use App\Data\PortfolioData;
use App\Enums\PortfolioStatusFilter;
use App\Traits\Scopes\SearchFilterScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo as LiftBelongsTo;
use WendellAdriel\Lift\Attributes\Relations\HasMany as LiftHasMany;
use WendellAdriel\Lift\Lift;

/**
 * Portfolio Model
 *
 * @property User $user
 * @property Collection<int, Service> $services
 * @property Collection<int, Link> $links
 * @property Collection<int, Project> $projects
 *
 * @method BelongsTo user()
 * @method static BelongsTo user()
 * @method HasMany services()
 * @method static HasMany services()
 * @method HasMany links()
 * @method static HasMany links()
 * @method HasMany projects()
 * @method static HasMany projects()
 * @method Builder filterSearch(string $search, array $columns)
 * @method static Builder filterSearch(string $search, array $columns)
 * @method Builder filterStatus(PortfolioStatusFilter $status)
 * @method static Builder filterStatus(PortfolioStatusFilter $status)
 */
#[LiftBelongsTo(User::class)]
#[LiftHasMany(Service::class)]
#[LiftHasMany(Link::class)]
#[LiftHasMany(Project::class)]
class Portfolio extends Model
{
    use Lift, HasFactory, SearchFilterScope, WithData;

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

    #[Config(fillable: true, column: 'about_me')]
    public string $aboutMe;

    #[Config(fillable: true)]
    public ?string $description;

    #[Config(cast: 'datetime', column: 'created_at')]
    public ?Carbon $createdAt;

    #[Config(cast: 'datetime', column: 'updated_at')]
    public ?Carbon $updatedAt;

    protected string $dataClass = PortfolioData::class;

    public function checkIfOwner(User $user): bool
    {
        return $user->id === $this->userId;
    }

    public static function validationRules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255'],
            'aboutMe' => ['required', 'string', 'min:100'],
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения',
            'title.min' => 'Поле "Заголовок" должно содержать не менее :min символов',
            'title.max' => 'Поле "Заголовок" должно содержать не более :max символов',
            'slug.required' => 'Поле "Slug" обязательно для заполнения',
            'slug.min' => 'Поле "Slug" должно содержать не менее :min символов',
            'slug.max' => 'Поле "Slug" должно содержать не более :max символов',
            'aboutMe.required' => 'Поле "О себе" обязательно для заполнения',
            'aboutMe.min' => 'Поле "О себе" должно содержать не менее :min символов'
        ];
    }

    public function scopeFilterStatus(Builder $query, PortfolioStatusFilter $status): void
    {
        if ($status === PortfolioStatusFilter::ALL) {
            return;
        }

        $query->where('is_active', $status === PortfolioStatusFilter::ACTIVE);
    }
}
