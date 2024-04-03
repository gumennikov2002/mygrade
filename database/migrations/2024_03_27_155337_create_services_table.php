<?php

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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id');
            $table->boolean('is_active')->default(1);
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 9, 3);
            $table->boolean('is_final_price')->default(1);
            $table->unsignedInteger('sort_order')
                ->nullable()
                ->default(1);
            $table->timestamps();

            $table->foreign('portfolio_id')
                ->references('id')
                ->on('portfolios')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
