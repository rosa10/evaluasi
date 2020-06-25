@extends('layouts.app')

@section('content')

<div class="box">
    <div class="box-body">

        <table class="box bordered-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($userTanpaJawaban as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
