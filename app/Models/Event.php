<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Enum\StatusEventType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'name',
    'latitude',
    'longitude',
    'organizer',
    'address',
    'status',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Scope a query to only include available event.
   */
  public function scopeAvailable($data)
  {
    return $data->where('status', StatusEventType::AVAILABLE->value);
  }

  public function getAvailable(): Collection
  {
    return $this->available()->get();
  }

  /**
   * Define badge status donor.
   *
   * @return string
   */
  public function getEventStatus(): string
  {
    $badgeClass = ($this->status == StatusEventType::AVAILABLE->value) ? 'badge text-primary' : 'badge text-danger';
    $badgeText = ($this->status == StatusEventType::AVAILABLE->value) ? StatusEventType::AVAILABLE->value : StatusEventType::UNAVAILABLE->value;

    return "<span class='{$badgeClass}'>{$badgeText}</span>";
  }
}
