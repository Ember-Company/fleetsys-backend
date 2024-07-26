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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->foreign('company_id')->references('id')->on('company')->constrained();
            $table->unsignedBigInteger('fuel_type_id');
            $table->foreign('fuel_type_id')->references('id')->on('fuel')->constrained();
            $table->string('fuel_volume_units');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_type')->constrained();
            $table->string('name');
            $table->string('ownership');
            $table->string('system_of_measurement');
            $table->string('primary_meter_unit');
            $table->uuid('current_location_id');
            $table->foreign('current_location_id')->references('id')->on('current_location')->constrained();
            $table->string('primary_meter_value')->nullable();
            $table->string('primary_meter_updated')->nullable();
            $table->string('primary_meter_usage_per_day')->nullable();
            $table->string('secondary_meter_unit')->nullable();
            $table->string('secondary_meter_value')->nullable();
            $table->uuid('vehicle_status_id');
            $table->foreign('vehicle_status_id')->references('id')->on('vehicle_status')->constrained();
            $table->string('secondary_meter_updated')->nullable();
            $table->string('secondary_meter_usage_per_day')->nullable();
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
            $table->integer('documents_count')->default(0);
            $table->integer('images_count')->default(0);      
            $table->integer('issues_count')->default(0);
            $table->integer('work_orders_count')->default(0);
            $table->string('group_ancestry')->nullable(); 
            $table->string('color')->nullable();    
            $table->string('license_plate')->nullable();    
            $table->string('vin')->nullable();    
            $table->string('year')->nullable();    
            $table->string('make')->nullable();    
            $table->string('model')->nullable();    
            $table->string('trim')->nullable();    
            $table->integer('registration_expiration_month');
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
            $table->foreignUuid('driver_id')->constrained();
            $table->string('default_img_url')->nullable();
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
