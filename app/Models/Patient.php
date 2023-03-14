<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Patient extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    const Male = 1;
    const Female = 2;

    protected $fillable = [
        'name',
        'last_name',
        'identity_card',
        'issued',
        'birthdate',
        'sex',
        'photo_path'
    ];

    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    public function record(): HasOne
    {
        return $this->hasOne(Record::class);
    }

    public function diagnostics(): HasMany
    {
        return $this->hasMany(Diagnostic::class);
    }
}
