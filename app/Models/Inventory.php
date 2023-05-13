<?php

namespace App\Models;

use App\Models\Offer;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Inventory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('preview')
    //         ->fit(Manipulations::FIT_CROP, 300, 300)
    //         ->nonQueued();
    // }

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offer()
    {
        return $this->hasOne(Offer::class, 'id', 'bean_id');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('inv_img')
            ->singleFile();
    }
}
