<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {

        Schema::create("users", function(Blueprint $table)
        {

            $table->id();
            $table->text("name");
            $table->text("email");
            $table->timestamp("email_verified_at")->nullable();
            $table->text("password");
            $table->rememberToken();
            $table->timestamps();

        });

    }

    public function down()
    {

        Schema::dropIfExists("users");

    }

}