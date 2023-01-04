<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToPropertyRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_rentals', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->boolean('property_rental')->default(1)->comment('0=monthly, 1=daily');
            $table->boolean('status')->default(1)->comment('0=not checkin, 1=checkin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_rentals', function (Blueprint $table) {
            $table->dropForeign('property_rentals_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('total_days');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('total_amount');
            $table->dropColumn('advance');
            $table->dropColumn('name');
            $table->dropColumn('pax');
            $table->dropColumn('vehicle');
            $table->dropColumn('mobile_no');
            $table->dropColumn('document_no');
            $table->dropColumn('expiry_date');
            $table->dropColumn('nationality');
            $table->dropColumn('company_name');
            $table->dropColumn('dob');
            $table->dropColumn('document_type');
            $table->dropColumn('payment_type');
            $table->dropColumn('board_type');
            $table->dropColumn('place_birth');
            $table->dropColumn('first_child_dob');
            $table->dropColumn('sec_chhild_dob');
            $table->dropColumn('infants');
            $table->dropColumn('email');
            $table->dropColumn('place_issue');
            $table->dropColumn('address');
            $table->dropColumn('property_rental');
            $table->dropColumn('status');
            
        });
    }
}
