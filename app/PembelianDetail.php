<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    public function sukucadang()
    {
        return $this->belongsTo(Sukucadang::class);
    }

    public function returpembelian()
    {
        return $this->hasMany(ReturPembelian::class);
    }
}
