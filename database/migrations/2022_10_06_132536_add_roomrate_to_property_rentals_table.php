<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomrateToPropertyRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_rentals', function (Blueprint $table) {
            $table->string('room_rate')->nullable()->after('advance');
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
            $table->dropColumn('room_rate');
        });
    }
}
