<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Payment extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }

    public function petani()
    {
        return $this->belongsTo(User::class,'petani_id','id');
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class,'pengelola_id','id');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('payment_proof')
            ->singleFile();
    }
}