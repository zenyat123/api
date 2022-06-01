<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Category extends Model
{

    use HasFactory, ApiTrait;

    protected $fillable = ["category", "url"];

    protected $allowIncluded = ["posts", "posts.user"];
    protected $allowFilter = ["id", "category", "url"];
    protected $allowSort = ["id", "category", "url"];

    public function posts()
    {

        return $this->hasMany(Post::class);

    }

}