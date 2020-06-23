@extends('layouts.app')
@section('page-title','Pilhan Evaluasi')
@section('content')
<div class="box">
    <div class="box-header with-border">
    <div class="card-body">
      {{-- <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a></code> tag to achieve the following:</p> --}}

      @foreach ($layanan as $layanan)
      
      @foreach ($layanan->kategori as $kategori)
      
      
      <a href="{{url('/jawaban/index/'.$kategori->id)}}" for="kategori_id" id="kategori_id" name="kategori_id" class="btn btn-app">
        
        {{-- @if ($layanan->id->diff($jawaban->layanan_id))  --}}
        <span  class="badge" style="background-color: orange">Belum diisi</span>
        {{-- @endif --}}
        
        {{-- @if ($kategori->layanan_id===$layanan->id) --}}
        
        
        <i class="fa fa-edit"></i> {{$layanan->layanan}}: {{$kategori->kategori}}
        
        {{-- @endif --}}
      
      </a>
      
      @endforeach
      <br/>
      @endforeach
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
    </div>

  @endsection