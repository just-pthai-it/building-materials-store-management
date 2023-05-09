<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

        protected $fillable = [
        'name',
        'parent_id',
    ];

    public function children () : HasMany
    {
        return $this->hasMany(Unit::class, 'parent_id');
    }

    public function parent () : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'parent_id');
    }

    public function product () : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
