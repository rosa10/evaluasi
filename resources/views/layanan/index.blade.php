@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('layanan/create')}}" class="btn btn-primary my-2 ">Tambah Layanan</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Layanan</th>
					            	<th scope="col">Semester</th>
						            <th scope="col"width="120px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($layanan as $layanan)
                        <tr>
                        <th>{{$loop->iteration}}</th>
                          <th>
                            {{implode(', ',$layanan->user()->get()->pluck('name')->sort()->toArray())}}
                          </th>
                          <th>{{$layanan->layanan}}</th>
                          <th>{{$layanan->semester}}</th>
                          <th>
                            <a href="{{route('layanan.edit',$layanan->id)}}" class="pull-left">
                              <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                    
                            <form action="{{route('layanan.destroy',$layanan->id)}}" method="post" class="pull-right">
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
