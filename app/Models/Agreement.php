<?php

namespace App\Models;

use App\Models\AgreementDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agreement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agreementDetail()
    {
        return $this->hasOne(AgreementDetail::class);
    }
}
