<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Builder;

class Yayasan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'latitude',
        'longitude',
        'verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'verified_at' => 'datetime',
        ];
    }

    /**
     * Get the user (representative) that manages this yayasan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the events hosted by this yayasan.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get all donations received by this yayasan through its events.
     */
    public function donations(): HasManyThrough
    {
        return $this->hasManyThrough(Donation::class, Event::class);
    }

    /**
     * Scope a query to only include verified yayasans.
     */
    public function scopeVerified(Builder $query): Builder
    {
        return $query->whereNotNull('verified_at');
    }

    /**
     * Scope a query to only include yayasans with active events.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereHas('events', function ($q) {
            $q->where('is_active', true);
        });
    }

    /**
     * Check if this yayasan is verified.
     */
    public function isVerified(): bool
    {
        return $this->verified_at !== null;
    }

    /**
     * Get total weight received by this yayasan (in kg).
     */
    public function getTotalReceivedKgAttribute(): float
    {
        return $this->donations()
            ->where('status', Donation::STATUS_RECEIVED)
            ->sum('weight_kg');
    }
}
