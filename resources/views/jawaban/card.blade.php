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
      
      
      <button for="kategori_id" id="kategori_id" name="kategori_id" class="btn btn-app" value="{{$kategori->id}}">
        
        {{-- @if ($layanan->id->diff($jawaban->layanan_id))  --}}
        <span  class="badge bg-warning">Belum diisi</span>
        {{-- @endif --}}
        
        {{-- @if ($kategori->layanan_id===$layanan->id) --}}
        
        
        <i type="submit" class="fa fa-edit"></i> {{$layanan->layanan}}: {{$kategori->kategori}}
        
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