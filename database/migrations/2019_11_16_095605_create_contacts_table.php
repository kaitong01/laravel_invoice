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

            $table->boolean('status')->default(1);

            $table->string('name');
            $table->string('avatar')->nullable(); // image: path, url
            $table->date('birthdate')->nullable();
            // $table->string('blood_group')->nullable();
            // $table->boolean('sex')->nullable();


            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('line')->nullable();

            $table->text('address')->nullable();
            // $table->text('current_location')->nullable();
            // $table->string('residence')->nullable();

            $table->string('company')->nullable();
            $table->string('job')->nullable();

            $table->text('remarks')->nullable();
            
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
