<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'yayasan_id',
        'title',
        'slug',
        'description',
        'banner_image',
        'start_date',
        'end_date',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from title
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
                
                // Ensure unique slug
                $originalSlug = $event->slug;
                $count = 1;
                while (static::where('slug', $event->slug)->exists()) {
                    $event->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    /**
     * Get the yayasan that hosts this event.
     */
    public function yayasan(): BelongsTo
    {
        return $this->belongsTo(Yayasan::class);
    }

    /**
     * Get the donations for this event.
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Scope a query to only include active events.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include ongoing events (no end date or end date in future).
     */
    public function scopeOngoing(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            });
    }

    /**
     * Scope a query to only include upcoming events.
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->whereNotNull('start_date')
            ->where('start_date', '>', now());
    }

    /**
     * Check if this is an ongoing/permanent event.
     */
    public function isOngoing(): bool
    {
        return $this->end_date === null;
    }

    /**
     * Get total weight donated to this event (in kg).
     */
    public function getTotalDonatedKgAttribute(): float
    {
        return $this->donations()
            ->where('status', Donation::STATUS_RECEIVED)
            ->sum('weight_kg');
    }
}
