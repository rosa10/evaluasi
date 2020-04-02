@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('pilihan/create')}}" class="btn btn-primary my-2 ">Tambah Pilihan</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pilihan</th>
                        <th scope="col">Value</th>
						<th scope="col"width="120px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($pilihan as $pilihan)
                        <tr>
                        <th>{{$loop->iteration}}</th>
                          <th>{{$pilihan->pilihan}}</th>
                          <th>{{$pilihan->value}}</th>
                          <th>
                            <a href="{{route('pilihan.edit',$pilihan->id)}}" class="pull-left">
                              <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                    
                            <form action="{{route('pilihan.destroy',$pilihan->id)}}" method="post" class="pull-right">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                          </th>
                          
                        </tr>
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
