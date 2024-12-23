<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiaoDeThi extends Model
{
    protected $table = 'giaodethi';
    public $timestamps = true;
    protected $fillable = [
        'id_dethi',
        'id_nhom',
    ];
    function nhom(): BelongsTo
    {
        return $this->belongsTo(Nhom::class, 'id_nhom', 'id');
    }
    function user(): BelongsTo
    {
        return $this->belongsTo(DeThi::class, 'id_dethi', 'id');
    }
}
