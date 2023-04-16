<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function partner()
    {
        return $this->hasOne(Partner::class,'id', 'partner_id');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class, 'id', 'offer_id');
    }

}
