<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTour
 */
class Tour extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopePublic($query)
    {
        return $query->whereStatus('public');
    }

    public function scopeDrafts($query, User $user)
    {
        return $query->where([
            'user_id' => $user->id,
            'status' => 'draft'
        ]);
    }
}
