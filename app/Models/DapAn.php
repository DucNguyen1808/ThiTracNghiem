<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DapAn extends Model
{

    protected $table = 'dapan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps= true;
    public function cauHois() :BelongsTo{
       return $this->belongsTo(CauHoi::class,'id_cauhoi','id');
    }

}
