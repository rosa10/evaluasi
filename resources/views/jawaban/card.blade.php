@extends('layouts.app')
@section('page-title')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 >Pilihan Evaluasi</h3>    
    <div class="card-body">
      {{-- <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a></code> tag to achieve the following:</p> --}}
      <form method="POST" action={{url('/jawaban/index')}}>
        @method('post')
        @csrf
      @foreach ($layanan as $layanan)
      @foreach ($layanan->kategori as $kategori)
      <input hidden name="kategori_id" value="{{$kategori->id}}">
      <button for="layanan_id" id="layanan_id" name="layanan_id" class="btn btn-app" value="{{$layanan->id}}">
        {{-- @if ($layanan->id->diff($jawaban->layanan_id))  --}}
        <span  class="badge bg-warning">Belum diisi</span>
        {{-- @endif --}}
        
        {{-- @if ($kategori->layanan_id===$layanan->id) --}}
        
        <i name="kategori_id" value="{{$kategori->id}}" type="submit" class="fa fa-edit"></i> {{$layanan->layanan}}: {{$kategori->kategori}}
        {{-- @endif --}}
        
      </button>
      
      @endforeach
      <br/>
      @endforeach
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
    </div>

  @endsection