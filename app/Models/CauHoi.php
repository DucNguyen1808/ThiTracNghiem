<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CauHoi extends Model
{
    protected $table = 'cauhoi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps= true;
    public function monHoc(): BelongsTo{
        return $this->belongsTo(MonHoc::class,'id_monhoc','id');
    }
    public function dapAns(): HasMany{
        return $this->hasMany(DapAn::class,'id_cauhoi','id');
    }
}
