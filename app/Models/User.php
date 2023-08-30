<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuid;
use App\Helpers\Enum\RoleType;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\Enum\StatusActiveType;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'name',
    'email',
    'phone',
    'password',
    'avatar',
    'status',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Check user have avatar or not.
   */
  public function hasAvatar(): bool
  {
    if ($this->avatar) {
      return true;
    }

    return false;
  }

  /**
   * Get user default user avatar.
   *
   * @return void
   */
  public function getUserAvatar()
  {
    if ($this->hasAvatar()) :
      return Storage::url($this->avatar);
    else :
      return asset('assets/images/default.png');
    endif;
  }

  /**
   * Get the user role name.
   */
  public function getRoleName(): string
  {
    return $this->roles->implode('name');
  }

  /**
   * Get the user role id.
   */
  public function getRoleId(): int
  {
    return $this->roles->implode('id');
  }

  /**
   * Get all user except :value
   *
   * @param  mixed $query
   * @return void
   */
  public function scopeWhereNotAdmin($query)
  {
    return $query->whereDoesntHave('roles', function ($row) {
      $row->where('name', RoleType::ADMIN->value);
    });
  }

  /**
   * Scope a query to only include active users.
   */
  public function scopeActive($data)
  {
    return $data->where('status', StatusActiveType::ACTIVE->value);
  }

  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  /**
   * Define badge status account.
   *
   * @return string
   */
  public function getAccountStatus(): string
  {
    $badgeClass = ($this->status == StatusActiveType::ACTIVE->value) ? 'badge text-success' : 'badge text-danger';
    $badgeText = ($this->status == StatusActiveType::ACTIVE->value) ? 'Active' : 'Inactive';

    return "<span class='{$badgeClass}'>{$badgeText}</span>";
  }

  /**
   * Define badge type roles.
   *
   * @return string
   */
  public function getRoleBadge(): string
  {
    $roleName = $this->getRoleName();

    switch ($roleName) {
      case RoleType::ADMIN->value:
        $badgeClass = 'badge text-smooth';
        break;
      case RoleType::OFFICER->value:
        $badgeClass = 'badge text-info';
        break;
      case RoleType::DONOR->value:
        $badgeClass = 'badge text-warning';
        break;
      default:
        $badgeClass = 'badge';
        break;
    }

    return "<span class='{$badgeClass}'>{$roleName}</span>";
  }

  /**
   * Relation to donor model.
   *
   * @return HasOne
   */
  public function donor(): HasOne
  {
    return $this->hasOne(Donor::class, 'user_id');
  }
}
