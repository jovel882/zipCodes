<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SettlementType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function settlements(): HasMany
    {
        return $this->hasMany(Settlement::class);
    }
}
