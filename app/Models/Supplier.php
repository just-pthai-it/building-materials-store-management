<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'representative',
        'representative_phone',
        'tax_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    private array $filterable = [
        'name',
    ];

    public function filterName (Builder $query, string $name) : void
    {
        $query->where('name', 'like', "%{$name}%");
    }
}
