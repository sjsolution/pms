<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRentypetoPropertyrentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_rentals', function (Blueprint $table) {
            $table->string('rent_type')->nullable()->after('tenant_company_name');
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
            $table->dropColumn('rent_type');
        });
    }
}
