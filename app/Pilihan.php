<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    protected $table = 'pilihan';
    protected $guarded=[];
    public function soal(){
    	return $this->belongsToMany('App\Soal');
    }
}