<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('dob',100)->nullable();
            $table->string('mobile',20)->unique();
            $table->string('email',100)->nullable();
            $table->string('password',100);
            $table->string('address',100)->nullable();
            $table->string('district',100)->nullable();
            $table->string('pincode',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('image',100)->nullable();
            $table->string('license_image',100)->nullable();
            $table->string('vehicle_type',100)->nullable();
            $table->string('vehicle_number',100)->nullable();
            $table->string('vehicle_image')->nullable();
            $table->string('rc_image',100)->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
