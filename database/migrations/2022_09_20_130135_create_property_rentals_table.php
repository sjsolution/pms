<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->unsignedBigInteger('flat_type')->nullable();
            $table->foreign('flat_type')->references('id')->on('flat_types')->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->string('tenant_name')->nullable();
            $table->string('tenant_contact_no')->nullable();
            $table->string('tenant_document_type')->nullable();
            $table->string('tenant_document_no')->nullable();
            $table->string('tenant_company_name')->nullable();
            $table->string('monthly_rent')->nullable();
            $table->string('rent_due_date')->nullable();
            $table->string('contract_start')->nullable();
            $table->string('contract_expire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_rentals');
    }
}
