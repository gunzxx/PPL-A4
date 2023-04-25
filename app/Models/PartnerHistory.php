<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id', 'id');
    }
}
