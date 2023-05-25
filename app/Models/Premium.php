<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Premium extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
