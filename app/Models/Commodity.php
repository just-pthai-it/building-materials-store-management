<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commodity extends Model
{
    use HasFactory;

    protected $fillable = [
        'specification_id',
        'total_amount',
        'current_amount',
    ];

    protected $attributes = [
        'total_amount'   => 0,
        'current_amount' => 0,
    ];

    public function inputInvoiceDetails () : HasMany
    {
        return $this->hasMany(InputInvoiceDetail::class);
    }

    public function specification () : BelongsTo
    {
        return $this->belongsTo(Specification::class);
    }
}
