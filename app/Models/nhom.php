<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nhom extends Model
{
    protected $table = 'nhom';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    function chiTietNhoms(): HasMany {
        return $this->HasMany(ChiTietNhom::class,'id_nhom','id');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'chitietnhom', 'id_nhom', 'id_user');
    }
    public function deThis(): BelongsToMany
    {
        return $this->belongsToMany(DeThi::class, 'giaodethi', 'id_nhom', 'id_dethi');
    }
}
