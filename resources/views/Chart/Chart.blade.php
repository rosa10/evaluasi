@extends('layouts.app')

@section('content')
<div class="box">

    <div class="box-header with-border">
        <a href="{{url('home')}}" class="btn btn-danger my-2 ">Kembali</a>
		<div class="box-tools pull-right">
		</div>
    </div>
<div class="box-body">
<div style="width: 50%">
    {!! $chart->container() !!}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!!$chart->script()!!}
</div>
</div>
@endsection