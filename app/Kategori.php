<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_layanan';
    protected $guarded=[];
    public function layanan(){ 
        return $this->belongsTo('App\Layanan'); 
  }
}
