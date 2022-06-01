<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{

    public function up()
    {

        Schema::create("categories", function(Blueprint $table)
        {

            $table->id();
            $table->text("category");
            $table->text("url");
            $table->timestamps();

        });

    }

    public function down()
    {

        Schema::dropIfExists("categories");

    }

}