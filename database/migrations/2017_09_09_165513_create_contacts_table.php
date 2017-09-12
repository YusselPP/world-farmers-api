<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('phoneNumber', 30);

            $table->string('products', 150);

            $table->date('startedWorking');

            $table->integer('landSize');
            $table->string('landSizeUnit', 5);

            $table->integer('harvestAmount');
            $table->string('harvestAmountUnit', 5);

            $table->string('locality');
            $table->decimal('latitude', 11, 7);
            $table->decimal('longitude', 11, 7);
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
        Schema::dropIfExists('contacts');
    }
}
