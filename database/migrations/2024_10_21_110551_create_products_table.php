<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('code')->default('00001');
            $table->string('name');
            // $table->foreignIdFor(Category::class, 'category_id');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->integer('stock');
            $table->integer('price');
            $table->text('description');
            $table->enum('status', ['aktif', 'non-aktif'])->default('non-aktif');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
