<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Post extends Model
{

    use HasFactory, ApiTrait;

    const DRAFT = 0;
    const PUBLISHED = 1;

    protected $fillable = ["title", "url", "resume", "content", "user_id", "category_id"];

    protected $allowIncluded = ["category", "user"];
    protected $allowFilter = ["id", "title", "url", "resume", "content"];
    protected $allowSort = ["id", "title", "url", "resume", "content"];

    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function category()
    {

        return $this->belongsTo(Category::class);

    }

    public function tags()
    {

        return $this->belongsToMany(Tag::class);

    }

    public function images()
    {

        return $this->morphMany(Image::class, "imageable");

    }

}