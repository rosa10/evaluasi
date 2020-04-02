@extends('layouts.app')
@section('page-title','User Management')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('admin/admin/users/create ')}}" class="btn btn-primary my-2 ">Tambah Pengguna</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col"width="120px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                          <th>{{$user->name}}</th>
                          <th>{{$user->email}}</th>
                          <th>{{implode(', ',$user->roles()->get()->pluck('name')->toArray())}}</th>
                          <th>
                            <a href="{{route('admin.users.edit',$user->id)}}" class="pull-left">
                              <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a>
                    
                            <form action="{{route('admin.users.destroy',$user->id)}}" method="post" class="pull-right">
                              @csrf
                              {{method_field('delete')}}
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
