<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transaction;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    
    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }

    public function petani()
    {
        return $this->belongsTo(User::class);
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('delivery_proof')
            ->singleFile();
    }
}