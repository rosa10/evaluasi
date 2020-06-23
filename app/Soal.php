<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $guarded = [];
    public function layanan()
    {
        return $this->belongsTo('App\Layanan');
    }
    public function pilihan()
    {
        return $this->belongsToMany('App\Pilihan');
    }

    public function jawaban()
    {
        return $this->hasMany('App\Jawaban');
    }
}
