<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->integer('token');
            $table->string('password');
            $table->integer('status')->default(0);
            $table->integer('role')->default(0);
            $table->string('app_token')->nullable();
            $table->decimal('balance')->default(0.00);
            $table->string('type')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('degree')->nullable();
            $table->string('category')->nullable();
            $table->integer('fees')->default(99);
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
        Schema::dropIfExists('users');
    }
}
