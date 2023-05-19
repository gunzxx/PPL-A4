<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Delivery;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id', 'id');
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id', 'id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
}