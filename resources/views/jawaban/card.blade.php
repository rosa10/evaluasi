@extends('layouts.app')
@section('page-title','Pilihan Evaluasi')
@section('content')
<div class="box">
    <div class="box-header with-border">
    <div class="card-body">
      @include('partials.alerts')

      @foreach ($layanan as $layanan)
      Layanan {{$layanan->layanan}}
      <br>
        @foreach ($layanan->kategori as $kategori)

          @if (count($kategori->jawaban->where('user_id', $user)) > 1)

            @if($bulanSekarang >= 7 && $bulanSekarang <= 12)
              @if($kategori->jawaban->where('user_id', $user)->pluck('ganjil')->first() == 1)
                @if($tahunSekarang > $kategori->jawaban->where('user_id', $user)->pluck('tahun')->first())
                  <a href="{{url('/jawaban/index/'.$kategori->id)}}" class="btn btn-app" aria-disabled="true">
                  <span  class="badge" style="background-color: orange">Belum diisi periode ganjil</span>
                  <i class="fa fa-edit"></i> {{$kategori->kategori}}
                  </a>
                @else
                  <button class="btn btn-app" disabled>      
                  <span  class="badge" style="background-color: green">Sudah diisi periode ganjil</span>
                  <i class="fa fa-edit"></i>  {{$kategori->kategori}}
                  </button>
                @endif
              @else 
                  <a href="{{url('/jawaban/index/'.$kategori->id)}}" class="btn btn-app" aria-disabled="true">
                  <span  class="badge" style="background-color: orange">Belum diisi periode ganjil</span>
                  <i class="fa fa-edit"></i>  {{$kategori->kategori}}
                  </a>
              @endif             
            @else
              @if($kategori->jawaban->where('user_id', $user)->pluck('genap')->first() == 1)

                @if($tahunSekarang > $kategori->jawaban->where('user_id', $user)->pluck('tahun')->first())
                  <a href="{{url('/jawaban/index/'.$kategori->id)}}" class="btn btn-app" aria-disabled="true">
                  <span  class="badge" style="background-color: orange">Belum diisi periode genap</span>
                  <i class="fa fa-edit"></i>  {{$kategori->kategori}}
                  </a>
                @else
                  <button class="btn btn-app" disabled>      
                  <span  class="badge" style="background-color: green">Sudah diisi periode genap</span>
                  <i class="fa fa-edit"></i>  {{$kategori->kategori}}
                  </button>
                @endif

              @else 
                  <a href="{{url('/jawaban/index/'.$kategori->id)}}" class="btn btn-app" aria-disabled="true">
                  <span  class="badge" style="background-color: orange">Belum diisi periode genap</span>
                  <i class="fa fa-edit"></i>  {{$kategori->kategori}}
                  </a>

              @endif
            @endif

          @else
            <a href="{{url('/jawaban/index/'.$kategori->id)}}" class="btn btn-app" aria-disabled="true">
                @if($bulanSekarang >= 7 && $bulanSekarang <= 12)
                  <span class="badge" style="background-color: orange">Belum diisi ganjil</span>
                @else
                  <span class="badge" style="background-color: orange">Belum diisi genap</span>
                @endif
                <i class="fa fa-edit"></i> {{$kategori->kategori}}
            </a>
          @endif

        @endforeach
      <br/>
      @endforeach
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
    </div>

  @endsection