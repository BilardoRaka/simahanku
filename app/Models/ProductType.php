<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'product_type_material', 'product_type_id', 'material_id')->withPivot('amount');
    }
}
