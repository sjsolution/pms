<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // drop the table
        Schema::dropIfExists('checkouts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // create the table
        Schema::disableForeignKeyConstraints();
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertyrental_id')->nullable();
            $table->foreign('propertyrental_id')->references('id')->on('property_rentals')->onDelete('cascade');
            $table->string('total_amount')->nullable();
            $table->string('advance')->nullable();
            $table->string('remaining')->nullable();
            $table->string('additional_charges')->nullable();
            $table->string('payment_type')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }
}
