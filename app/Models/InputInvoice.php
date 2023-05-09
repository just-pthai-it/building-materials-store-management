<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InputInvoice extends Model
{
    use HasFactory, HasFilter;

    public const UPDATED_AT = null;

    protected $fillable = [
        'supplier_id',
        'user_id',
        'payment_method',
        'supplier_bank',
        'supplier_bank_account_number',
        'deliver_name',
        'deliver_phone',
        'total',
        'created_at',
    ];

    protected $attributes = [
        'total' => 0,
    ];

    private array $filterable = [
        'created_at',
    ];

    private array $sortable = [
        'created_at',
    ];

    public function filterCreatedAt (Builder $query, string $rawValue) : void
    {
        [$start, $end] = explode('&&', $rawValue);
        $query->whereBetween('created_at', [$start, "{$end} 23:59:59"]);
    }

    public function details () : HasMany
    {
        return $this->hasMany(InputInvoiceDetail::class);
    }

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function supplier () : BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
