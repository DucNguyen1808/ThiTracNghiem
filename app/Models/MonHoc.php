<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonHoc extends Model
{
    protected $table = 'monhoc';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps= true;
    protected $fillable = ['ten'];

    public function cauHois(): HasMany
    {
        return $this->hasMany(CauHoi::class, 'id_monhoc', 'id');
    }

    public function deThis(): HasMany
    {
        return $this->hasMany(DeThi::class, 'id_monhoc', 'id');
    }
}
