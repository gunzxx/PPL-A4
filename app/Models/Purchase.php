<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function pengelola()
    {
        return $this->belongsTo(User::class,'pengelola_id','id');
    }

    public function agreement_detail()
    {
        return $this->belongsTo(AgreementDetail::class, 'agreement_detail_id', 'id');
    }
}
