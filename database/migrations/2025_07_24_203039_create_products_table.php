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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("code");
            $table->string("sex");
            $table->string("description")->nullable();
            $table->string('image')->nullable();
            $table->string('special')->nullable();
            $table->integer("price");
             $table->integer("ml")->nullable();
            $table->integer("quantity")->nullable();
            $table->integer("number_of_sales")->nullable();

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
