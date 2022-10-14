<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToPropertyRentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_rentals', function (Blueprint $table) {
            $table->string('tenant_pay_amount')->nullable()->after('monthly_rent');
            $table->string('tenant_remaining_amount')->nullable()->after('tenant_pay_amount');
            $table->softDeletes();
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
            $table->dropColumn('tenant_pay_amount');
            $table->dropColumn('tenant_remaining_amount');
            $table->dropSoftDeletes();
        });
    }
}
