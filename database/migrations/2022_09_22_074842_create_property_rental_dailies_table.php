<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRentalDailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_rental_dailies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->unsignedBigInteger('flat_type')->nullable();
            $table->foreign('flat_type')->references('id')->on('flat_types')->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->string('total_days')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('advance')->nullable();
            $table->string('name')->nullable();
            $table->string('pax')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('document_no')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('company_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('document_type')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('board_type')->nullable();
            $table->string('place_birth')->nullable();
            $table->string('first_child_dob')->nullable();
            $table->string('sec_chhild_dob')->nullable();
            $table->string('infants')->nullable();
            $table->string('email')->nullable();
            $table->string('place_issue')->nullable();
            $table->string('address')->nullable();
            $table->boolean('status')->default(1)->comment('0=not checkin, 1=checkin');
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
        Schema::dropIfExists('property_rental_dailies');
    }
}
