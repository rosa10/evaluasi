<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $guarded=[];
    public function user(){ 
        return $this->belongsTo('App\User'); 
    }
    public function kategori(){ 
        return $this->hasMany('App\Kategori'); 
    }
}
