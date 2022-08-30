<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function zip_codes(): HasMany
    {
        return $this->hasMany(ZipCode::class);
    }
}
