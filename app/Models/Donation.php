<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Builder;

class Donation extends Model
{
    use HasFactory;

    // Status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_RECEIVED = 'received';

    // Delivery method constants
    public const DELIVERY_SELF = 'self';
    public const DELIVERY_COURIER = 'courier';
    public const DELIVERY_EXPEDITION = 'expedition';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'weight_kg',
        'description',
        'delivery_method',
        'status',
        'rejection_reason',
        'image_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'weight_kg' => 'decimal:2',
        ];
    }

    /**
     * Get the donor (user) who made this donation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event this donation is for.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the yayasan through the event.
     */
    public function yayasan(): HasOneThrough
    {
        return $this->hasOneThrough(
            Yayasan::class,
            Event::class,
            'id',        // Foreign key on events table
            'id',        // Foreign key on yayasans table
            'event_id',  // Local key on donations table
            'yayasan_id' // Local key on events table
        );
    }

    /**
     * Scope a query to only include pending donations.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope a query to only include accepted donations.
     */
    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACCEPTED);
    }

    /**
     * Scope a query to only include received donations.
     */
    public function scopeReceived(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_RECEIVED);
    }

    /**
     * Check if donation is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if donation is accepted.
     */
    public function isAccepted(): bool
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    /**
     * Check if donation is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Check if donation is received.
     */
    public function isReceived(): bool
    {
        return $this->status === self::STATUS_RECEIVED;
    }

    /**
     * Get human-readable status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Menunggu Konfirmasi',
            self::STATUS_ACCEPTED => 'Diterima - Menunggu Pengiriman',
            self::STATUS_REJECTED => 'Ditolak',
            self::STATUS_RECEIVED => 'Sudah Diterima',
            default => 'Unknown',
        };
    }

    /**
     * Get human-readable delivery method label.
     */
    public function getDeliveryMethodLabelAttribute(): string
    {
        return match($this->delivery_method) {
            self::DELIVERY_SELF => 'Diantar Sendiri',
            self::DELIVERY_COURIER => 'Kurir Online (Gojek/Grab)',
            self::DELIVERY_EXPEDITION => 'Ekspedisi (JNE/J&T)',
            default => 'Unknown',
        };
    }
}
