<?php

namespace App\Models;

use App\Models\User;
use App\Models\Inventory;
use App\Models\OfferDetail;
// use App\Models\PartnerDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id', 'id');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class,'id', 'bean_id');
    }

    public function offerDetail()
    {
        return $this->hasOne(OfferDetail::class);
    }
}
