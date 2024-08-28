<?php

use App\Enums\FuelType;
use App\Enums\FuelVolumeUnit;
use App\Enums\MeasurementSystem;
use App\Enums\MeterUnit;
use App\Enums\VehicleOwnership;
use App\Enums\VehicleStatus;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('company_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('vehicle_type_id')->constrained();
            $table->foreignUuid('vehicle_status_id')->constrained();

            $table->foreignUuid('current_location_id')->nullable()->constrained()->nullOnDelete();

            $table->unsignedInteger('fuel_volume_unit')->default(FuelVolumeUnit::LITERS);
            $table->unsignedInteger('fuel_type')->default(FuelType::Diesel);
            $table->unsignedInteger('system_of_measurement')->default(MeasurementSystem::METRIC);
            $table->unsignedInteger('primary_meter_unit')->default(MeterUnit::KILOMETER);
            $table->unsignedInteger('ownership')->default(VehicleOwnership::OWNED);

            $table->string('name');

            $table->bigInteger('primary_meter_value')->nullable();
            $table->bigInteger('primary_meter_usage_per_day')->nullable();

            $table->string('in_service_meter_value')->nullable();
            $table->dateTime('in_service_date')->nullable();
            $table->string('out_of_service_meter_value')->nullable();
            $table->dateTime('out_of_service_date')->nullable();

            $table->integer('estimated_service_months')->nullable();
            $table->string('estimated_replacement_mileage')->nullable();
            $table->integer('estimated_resale_price_cents')->nullable();

            $table->integer('fuel_entries_count')->default(0);
            $table->integer('service_entries_count')->default(0);
            $table->integer('service_reminders_count')->default(0);
            $table->integer('vehicle_renewal_reminders_count')->default(0);

            $table->string('color')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('vin')->nullable();
            $table->year('year')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('trim')->nullable();

            $table->integer('documents_count')->default(0);
            $table->integer('images_count')->default(0);
            $table->integer('issues_count')->default(0);
            $table->integer('work_orders_count')->default(0);


            $table->integer('registration_expiration_month')->nullable();
            $table->string('registration_state')->nullable();
            $table->string('default_image_url_small')->nullable();

            $table->string('loan_account_number')->nullable();
            $table->dateTime('loan_ended_at')->nullable();
            $table->string('loan_interest_rate')->nullable();
            $table->text('loan_description')->nullable();
            $table->foreignUuid('loan_vendor_id')->nullable()->constrained();
            $table->dateTime('loan_started_at')->nullable();
            $table->string('loan_vendor_name')->nullable();
            $table->integer('inspection_schedules_count')->default(0);
            $table->json('specs')->nullable();
            $table->string('default_img_url')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
