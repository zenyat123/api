<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Employee extends Model
{

    use HasFactory, ApiTrait;

    protected $fillable = ["names", "job"];

    protected $allowFilter = ["id", "names", "job"];
    protected $allowSort = ["id", "names", "job"];

}