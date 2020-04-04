@extends('layouts.app')
@section('page-title','Edit User '.$user->name)
@section('content')

<div class="box">

    <div class="box-header with-border">
        <a href="{{url('admin/user')}}" class="btn btn-danger my-2 ">Kembali</a>
		<div class="box-tools pull-right">
		</div>
    </div>

    <div class="box-body">

        <form method="post" action="{{url('/admin/user/'.$user->id)}}">
            @method('patch')
            @csrf
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="cth: Dosen UPT TIK" value="{{old('name', $user->name)}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="Cth: mahasiswa@gmail.com" value="{{old('email', $user->email)}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="checkbox">Pilihan Role Akun</label>
                    @foreach($role as $roles)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{$roles->id}}" @if($user->roles->pluck('id')->contains($roles->id)) checked @endif>
                        <label> {{$roles->name}} </label>
                    </div>
                    @endforeach
                </div>
            
            <button type="submit" class="btn btn-success mr-2">Ubah Data</button>

        </form>

    </div>


</div>

@endsection