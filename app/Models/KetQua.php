<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class KetQua extends Model
{
    protected $table = 'ketqua';
    public $incrementing = false;
    protected $primaryKey = [
        'id_dethi',
        'id_user'
    ];
    public $timestamps = true;
    public function deThi(): BelongsTo
    {
        return $this->belongsTo(DeThi::class, 'id_dethi', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function nhom(): BelongsTo
    {
        return $this->belongsTo(Nhom::class, 'id_nhom', 'id');
    }
}
