<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'brand_name',
        'description',
        'tax',
        'unit_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $attributes = [
        'tax' => 10,
    ];

    public function category () : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function specifications () : HasMany
    {
        return $this->hasMany(Specification::class);
    }

    public function unit () : BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
