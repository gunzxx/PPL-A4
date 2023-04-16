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
        return $this->hasOne(Partner::class, 'partner_id', 'id');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class, 'offer_id', 'id');
    }

}
