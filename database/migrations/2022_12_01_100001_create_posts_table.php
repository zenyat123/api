<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Post;

class CreatePostsTable extends Migration
{

    public function up()
    {

        Schema::create("posts", function(Blueprint $table)
        {

            $table->id();
            $table->text("title");
            $table->text("url");
            $table->text("resume");
            $table->text("content");
            $table->enum("status", [Post::DRAFT, Post::PUBLISHED])->default(Post::DRAFT);
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("category_id")->constrained()->onDelete("cascade");
            $table->timestamps();

        });

    }

    public function down()
    {

        Schema::dropIfExists("posts");

    }

}