<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Offer;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('preview')
    //         ->fit(Manipulations::FIT_CROP, 300, 300)
    //         ->nonQueued();
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offer()
    {
        return $this->hasOne(Offer::class, 'id', 'bean_id');
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('inv_img')
            ->singleFile();
    }
}
