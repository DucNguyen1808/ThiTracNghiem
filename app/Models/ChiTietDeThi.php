<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietDeThi extends Model
{
    protected $table = 'chitietdethi';
    public $timestamps = true;
    protected $primaryKey = ['id_cauhoi', 'id_de'];
    public $incrementing = false;

    protected $fillable = [
        'id_cauhoi',
        'id_de',
    ];

    public function cauHoi(): BelongsTo
    {
        return $this->belongsTo(CauHoi::class, 'id_cauhoi', 'id');
    }
    public function deThi(): BelongsTo
    {
        return $this->belongsTo(DeThi::class, 'id_de', 'id');
    }
}
