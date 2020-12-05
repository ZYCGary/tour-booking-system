<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperTour
 */
class Tour extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function isPublic(): bool
    {
        return $this->status === 'public';
    }

    public function scopePublic($query)
    {
        return $query->whereStatus('public');
    }

    public function scopeListings($query, User $user)
    {
        return $query->where([
            'user_id' => $user->id,
        ]);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dates(): HasMany
    {
        return $this->hasMany(TourDate::class);
    }
}
