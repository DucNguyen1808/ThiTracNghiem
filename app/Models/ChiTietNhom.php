<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietNhom extends Model
{
    protected $table = 'chitietnhom';
    public $timestamps = true;
    protected $primaryKey = ['id_nhom', 'id_user'];
    public $incrementing = false;

    protected $fillable = [
        'id_nhom',
        'id_user',
    ];

    public function nhom(): BelongsTo
    {
        return $this->belongsTo(Nhom::class, 'id_nhom', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
