<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasFilter;

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

    private array $filterable = [
        'name',
        'brand_name',
    ];

    public function filterName (Builder $query, string $name) : void
    {
        $query->where('name', 'like', "%{$name}%");
    }

    public function filterBrandName (Builder $query, string $name) : void
    {
        $query->where('brand_name', 'like', "%{$name}%");
    }

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
