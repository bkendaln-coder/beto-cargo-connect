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
Schema::create('packages', function (Blueprint $table) {
    $table->id();

    $table->string('tracking_number')->unique();

    $table->foreignId('customer_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('description');
    $table->decimal('weight_kg', 8, 2)->nullable();

    $table->string('transport_mode')->default('air');
    $table->string('origin_city')->default('Toronto');
    $table->string('destination_city')->default('Kinshasa');

    $table->string('status')->default('received');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
