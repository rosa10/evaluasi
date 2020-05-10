@extends('layouts.app')
@section('page-title','Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <div class="box-body">
    <form method="post" action="{{url('/jawaban/store')}}">
      @csrf         
      @foreach ($kategori as $key=>$datakategori)
            @if($request->kategori_id==$datakategori->id)
          <p  hidden>{{$layananId=$datakategori->layanan_id}}</p>
          @endif
      @endforeach
      <p hidden>{{$bil=0}}</p>
      @foreach ($soal as $soal)
      {{-- {{$datasoal}} --}}
        @if ($layananId==($soal->layanan_id))
          <p hidden>{{$bil++}}</p>
          <div class="form-group">
            <label for="formGroupExampleInput" > 
            <input name="soal[]" type="hidden" value="{{$soal->id}}">
              {{$bil}}. {{$soal->soal}}
            </label> 
            <br/>
            @foreach ($soal->pilihan as $plh)
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="nilai[{{$soal->id}}]" value={{$plh->value}}>
              <label class="form-check-label">{{$plh->pilihan}}</label>
              </div>
            @endforeach
          </div>
        @endif
      @endforeach
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Kritik dan Saran</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='kritik'></textarea>
      </div>
      <input hidden name="kategori_id" value="{{$request->kategori_id}}">
      <input hidden name="layanan_id" value="{{$layananId}}">
      <button name="user_id" value="{{ Auth::user()->id }}" type="submit" class="btn btn-primary ">Submit</button>
      <br>
      <br>
      <br>
    </form>
  </div>
</div>
</div>
@endsection