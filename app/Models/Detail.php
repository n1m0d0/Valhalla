<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Detail extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
