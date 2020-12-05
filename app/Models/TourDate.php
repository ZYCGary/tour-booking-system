<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTourDate
 */
class TourDate extends Model
{
    use HasFactory;

    public function scopeEnabled($query)
    {
        $query->whereStatus('enabled');
    }

    public function scopeDisabled($query)
    {
        $query->whereStatus('disabled');
    }
}
