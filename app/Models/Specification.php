<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Specification extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'price',
        'current_amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $attributes = [
        'current_amount' => 0,
        'price'          => 1,
    ];

    public function commodity () : HasOne
    {
        return $this->hasOne(Commodity::class);
    }

    public function product () : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productTypes () : BelongsToMany
    {
        return $this->belongsToMany(ProductType::class, 'product_type_specification');
    }
}
