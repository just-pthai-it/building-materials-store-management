<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use HasFactory, SoftDeletes, HasFilter;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'parent_id',
        'delete_at',
    ];

    protected $hidden = [
        'pivot',
    ];

    private array $filterable = [
        'parent_id',
    ];

    public function children () : HasMany
    {
        return $this->hasMany(ProductType::class, 'parent_id');
    }

    public function parent () : BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'parent_id');
    }

    public function specifications () : BelongsToMany
    {
        return $this->belongsToMany(Specification::class, 'product_type_specification');
    }
}
