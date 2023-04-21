<?php

use App\Models\Material;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_material', function (Blueprint $table) {
            $table->foreignIdFor(Material::class,'material_id');
            $table->foreignIdFor(Product::class,'product_id');
            $table->string('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_product');
    }
};
