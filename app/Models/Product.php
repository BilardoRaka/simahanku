<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'product_material', 'product_id', 'material_id')->withPivot('amount');
    }
}
