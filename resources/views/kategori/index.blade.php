@extends('layouts/app')
@section('title','Edit Kategori Layanan')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('kategori/create')}}" class="btn btn-primary my-2 ">Tambah Kategori Layanan</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Ketegori</th>
                        <th scope="col"width="120px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $kategori)
                        <tr>
                        <th>{{$loop->iteration}}</th>
                          <th>
                            {{implode(', ',$kategori->layanan()->get()->pluck('layanan')->sort()->toArray())}}
                          </th>
                          <th>{{$kategori->kategori}}</th>
                          <th>
                            <a href="{{route('kategori.edit',$kategori->id)}}" class="btn btn-primary btn-sm pull-left">Edit</button>
                            </a>
                    
                            <form action="{{route('kategori.destroy',$kategori->id)}}" method="post" >
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm pull-right">Delete</button>
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
