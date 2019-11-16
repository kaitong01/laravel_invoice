<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('company_id')->nullable();
            $table->integer('role_id')->nullable();

            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('status')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // $table->index(['id', 'company_id', 'role_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
