<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeThi extends Model
{
    protected $table = 'dethi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps= true;

    public function monHoc(): BelongsTo
    {
        return $this->belongsTo(MonHoc::class, 'id_monhoc', 'id');
    }

    public function cauHois(): BelongsToMany
    {
        return $this->belongsToMany(CauHoi::class, 'chitietdethi', 'id_de', 'id_cauhoi');
    }
    public function nhoms(): BelongsToMany
    {
        return $this->belongsToMany(Nhom::class, 'giaodethi', 'id_dethi', 'id_nhom');
    }
}
