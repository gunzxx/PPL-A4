<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\Inventories;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements JWTSubject, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;
    
    // protected $fillable = ['fullname','email','password',];
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inventory()
    {
        return $this->hasMany(Inventories::class);
    }

    public function partner()
    {
        return $this->hasMany(Partner::class);
    }

    public function offer()
    {
        return $this->hasMany(Offer::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function registerMediaCollections():void
    {
        $this
            ->addMediaCollection('profile')
            ->singleFile();
        $this
            ->addMediaCollection('tes')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // $this->addMediaCollection('profile')
    }
}
