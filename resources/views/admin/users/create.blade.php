@extends('layouts.app')
@section('page-title','Tambah User')
@section('content')

<div class="box">

    <div class="box-header with-border">
        <a href="{{url('admin/user')}}" class="btn btn-danger my-2 ">Kembali</a>
		<div class="box-tools pull-right">
		</div>
    </div>

    <div class="box-body">

        <form method="post" action="{{url('/admin/user')}}">

            @csrf
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="cth: Dosen UPT TIK" value="{{old('name')}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="Cth: mahasiswa@gmail.com" value="{{old('email')}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Password user" value="{{old('password')}}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="checkbox">Pilihan Role Akun</label>
                    @foreach($role as $roles)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{$roles->id}}">
                        <label> {{$roles->name}} </label>
                    </div>
                    @endforeach
                </div>
            
            <button type="submit" class="btn btn-primary mr-2">Tambah Data</button>

        </form>

    </div>


</div>

@endsection