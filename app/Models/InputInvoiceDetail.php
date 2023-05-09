<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputInvoiceDetail extends Model
{
    use HasFactory;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected $fillable = [
        'input_invoice_id',
        'commodity_id',
        'amount',
        'price',
    ];

    public function invoice () : BelongsTo
    {
        return $this->belongsTo(InputInvoice::class);
    }

    public function commodity () : BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }
}
