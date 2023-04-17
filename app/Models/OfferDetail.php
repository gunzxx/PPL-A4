<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\Partner;
use App\Models\AgreementDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfferDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function partner()
    {
        return $this->hasOne(Partner::class, 'id', 'partner_id');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class, 'id', 'offer_id');
    }

    public function agreementDetail()
    {
        return $this->hasOne(AgreementDetail::class);
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id', 'id');
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id', 'id');
    }
}
