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

    public function scopePublic($query)
    {
        return $query->whereStatus('public');
    }
}
