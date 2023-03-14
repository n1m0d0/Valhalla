<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Question extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }
}
