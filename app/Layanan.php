<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $guarded = [];

    public function kategori()
    {
        return $this->hasMany('App\Kategori');
    }
    public function jawaban()
    {
        return $this->hasMany('App\Jawaban');
    }
}
