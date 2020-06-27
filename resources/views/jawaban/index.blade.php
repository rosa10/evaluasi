@extends('layouts.app')
@section('page-title','Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <a href="{{url('jawaban')}}" class="btn btn-danger my-2 ">Kembali</a>
		<div class="box-tools pull-right">
		</div>
        <div class="box-body">

        
    

            <form method="post" action="{{url('/jawaban/store/'.$kategori->id)}}">
                @csrf
                <div class="form-group">
                    @foreach ($soal as $soalValue)
                    <input type="hidden" name="soal[]" value="{{$soalValue->id}}" required>
                    {{$loop->iteration}}. {{$soalValue->soal}}
                    <br>
                    @foreach ($soalValue->pilihan as $pilihan)
                    <div class="radio-inline">
                        <label class="form-check-label">
                            <input type="radio" name="nilai[{{$soalValue->id}}]" value="{{$pilihan->value}}"
                                class="form-check-input" required>

                            {{$pilihan->pilihan}}</label>
                    </div>
                    @endforeach
                    <br>

                    @endforeach
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Kritik dan Saran</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='kritik'
                        required></textarea>
                </div>
                {{-- <input hidden name="kategori_id" value="{{$request->kategori_id}}">
                <input hidden name="layanan_id" value="{{$layananId}}"> --}}
                <button name="user_id" value="{{ Auth::user()->id }}" type="submit"
                    class="btn btn-primary ">Submit</button>
                <br>
                <br>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection