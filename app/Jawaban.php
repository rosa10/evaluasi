<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $guarded=[];
    protected $fillable = [
        'user_id', 
        'layanan_id',
        'soal_id',
        'nilai', 
        'kritik',
        'status ',
    ];
    public function user(){ 
        return $this->belongsTo('App\User'); 
}
    public function soal(){
        return $this->belongsTo('App\Soal');
    }
}