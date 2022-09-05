<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ZipCode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function federal_entity(): BelongsTo
    {
        return $this->belongsTo(FederalEntity::class);
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function settlements(): HasMany
    {
        return $this->hasMany(Settlement::class)->orderBy('key', 'ASC');
    }
}
