<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agreement;
use App\Models\OfferDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgreementDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function offerDetail()
    {
        return $this->hasOne(OfferDetail::class, 'id', 'offer_detail_id');
    }

    public function agreement()
    {
        return $this->hasOne(Agreement::class,'id','agreement_id');
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class,'pengelola_id','id');
    }

    public function petani()
    {
        return $this->belongsTo(User::class,'petani_id','id');
    }
}
