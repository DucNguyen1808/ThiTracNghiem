<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = 'monhoc';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps= true;
    protected $filltable = ['ten'];
}
