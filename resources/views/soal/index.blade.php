@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('soal/create')}}" class="btn btn-primary my-2 ">Tambah Soal</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Soal</th>
                        <th scope="col">Pilihan</th>
						            <th scope="col"width="120px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($soal as $soal)
                        <tr>
                        <th>{{$loop->iteration}}</th>
                          <th>
                            {{implode(', ',$soal->layanan()->get()->pluck('layanan')->sort()->toArray())}}
                          </th>
                          <th>{{$soal->soal}}</th>
                          <th>
                            {{implode(', ',$soal->pilihan()->get()->pluck('pilihan')->sort()->toArray())}}
                          </th>
				                  
                          <th>
                            <a href="{{route('soal.edit',$soal->id)}}" class="pull-left">
                              <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                    
                            <form action="{{route('soal.destroy',$soal->id)}}" method="post" class="pull-right">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                          </th>
                          
                        </tr>
                      
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
