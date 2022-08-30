<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settlement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function zip_code(): BelongsTo
    {
        return $this->belongsTo(ZipCode::class);
    }

    public function settlement_type(): BelongsTo
    {
        return $this->belongsTo(SettlementType::class);
    }
}
