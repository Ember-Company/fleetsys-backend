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
        Schema::create('vehicle_assignments', function (Blueprint $table) {
            $table->uuid('id')->primary();        
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();            
            $table->string('starting_meter_entry')->nullable();
            $table->string('ending_meter_entry')->nullable();
            $table->text('comments')->nullable();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('vehicle_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_assignments');
    }
};
