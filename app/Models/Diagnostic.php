<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostic extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function tooth(): BelongsTo
    {
        return $this->belongsTo(Tooth::class);
    }
}
