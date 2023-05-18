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
        return $this->hasOne(Transaction::class);
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id', 'id');
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('profile')
            ->singleFile();
    }
}