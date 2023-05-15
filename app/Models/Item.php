<?php

namespace App\Models;

use App\Models\User;
use App\Models\Inventory;
use App\Models\AgreementDetail;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

    public function agreementDetail()
    {
        return $this->hasOne(AgreementDetail::class, 'id', 'agreement_detail_id');
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id', 'id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product')
            ->singleFile();
    }
}
