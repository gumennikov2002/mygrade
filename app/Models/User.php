<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Lift;

#[HasMany(Portfolio::class)]
class User extends Authenticatable
{
    use Lift, HasApiTokens, HasFactory, Notifiable;

    #[PrimaryKey]
    public int $id;

    #[Config(fillable: true)]
    public string $email;

    #[Config(fillable: true)]
    public string $name;

    #[Config(fillable: true)]
    public string $username;

    #[Config(cast: 'hashed', fillable: true, hidden: true)]
    public string $password;

    #[Config(hidden: true, column: 'remember_token')]
    public ?string $rememberToken;

    #[Config(cast: 'datetime', hidden: true, column: 'email_verified_at')]
    public ?Carbon $emailVerifiedAt;

    #[Config(cast: 'datetime', column: 'created_at')]
    public ?Carbon $createdAt;

    #[Config(cast: 'datetime', column: 'updated_at')]
    public ?Carbon $updatedAt;

    public static function suggestUsername(): string
    {
        $lastUserId = User::query()->max('id') ?? 0;
        return 'user' . $lastUserId + 1;
    }
}
