<?php

namespace App\Models;

use App\Models\User;
use App\Models\AgreementDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
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
