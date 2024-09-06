<?php

use App\Enums\SubscriptionType;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');

            $table->string('industry');
            $table->unsignedInteger('users_count')->default(0);
            $table->unsignedInteger('vehicles_count')->default(0);
            $table->integer('max_vehicles')->default(10);
            $table->boolean('active')->default(false);

            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');

            $table->string('country');
            $table->string('state');
            $table->string('city');

            $table->integer('max_drivers')->default(10);
            $table->integer('max_routes')->default(10);

            $table->boolean('has_support_access')->default(false);
            $table->timestamp('last_active_at')->nullable();
            // $table->index('last_active_at');

            $table->string('subscription_type')->default(SubscriptionType::MONTHLY);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
