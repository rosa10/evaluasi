<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
  protected $table = 'kategori_layanan';
  protected $guarded = [];
  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function layanan()
  {
    return $this->belongsTo('App\Layanan');
  }
  public function jawaban()
  {
    return $this->hasMany('App\Jawaban');
  }
}
