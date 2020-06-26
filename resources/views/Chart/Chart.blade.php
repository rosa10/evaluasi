@extends('layouts.app')

@section('page-title','Chart')

  @section('content')
  <!-- Default box -->
  @include('partials.alerts')
  <div class="box">
    <div class="box-header with-border">
        
      Halaman ini adalah untuk melihat hasil pengisian evaluasi dalam bentuk chart
       {{-- <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div> --}}
    </div>
    <div class="box-body">
      <form method="get" action="" id="formSubmit">
		@csrf
          <div class="form-group">
            @if($errors->has('layanan_id'))
            <div class="alert alert-danger">
            <strong>{{$errors->first('layanan_id')}}</strong>
            </div>
            @endif
			<label for="layanan">Layanan</label>
			<select for="layanan_id" id="layanan_id" name="layanan_id" class="form-control" required>
        <option selected disabled>
          Pilih Layanan
        </option>
				@foreach ($layanan as $layanan)
				<option  value="{{$layanan->id}}">
					{{$layanan->layanan}}
				</option>
				@endforeach
			</select>
        </div>
        <div class="form-group">
          @if($errors->has('kategori_id'))
            <div class="alert alert-danger">
            <strong>{{$errors->first('kategori_id')}}</strong>
            </div>
            @endif
			<label for="kategori">Kategori</label>
			<select for="kategori_id" id="kategori_id" name="kategori_id" class="form-control" required>

				<option  selected disabled >
          Pilih Kategori
				</option>
			</select>
        </div>
        <div class="form-group">
          @if($errors->has('periode'))
            <div class="alert alert-danger">
            <strong>{{$errors->first('periode')}}</strong>
            </div>
            @endif
                        	<label for="kategori">Semester</label>
			<select  id="periode" name="periode" class="form-control" required>

				<option  selected disabled required>
          Semester
        </option>
        <option value="1">Ganjil</option>
        <option value="2">Genap</option>
			</select>
                      </div>
        <div class="form-group">
          @if($errors->has('layanan_id'))
            <div class="alert alert-danger">
            <strong>{{$errors->first('layanan_id')}}</strong>
            </div>
            @endif
         	<label for="kategori">Tahun</label>
			<input  type="text" name="tahun"
       class="datepicker-here"
       data-language='en'
       data-min-view="years"
       data-view="years"
       data-date-format="yyyy" />
			</select>
                      </div>
        <button id="button_chart" type="submit" class="btn btn-primary" data-url="{{url('chart2')}}">Lihat Chart</button>
        <button id="button_hasil" type="submit" class="btn btn-warning" data-url="{{url('hasil')}}">Lihat Hasil</button>
        <button id="button_status" type="submit" class="btn btn-danger" data-url="{{url('status')}}">Status Pengisian</button>
      </form>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->
  @endsection
  @section('javascript')
    <script>
      $(document).ready(function(){
        $('select[name=layanan_id]').change(function(){
          var url='{{url('layanan')}}'+'/'+$(this).val()+'/kategori';
          $.get(url,function(data){
            var select=$('#kategori_id');
            select.empty();
            $.each(data,function(key,value){
              select.append('<option value='+value.id+'>'+value.kategori+'</option>');
            });
          });
        });

        $('#button_chart').click(function() {
          var url = $(this).attr('data-url');
          $("#formSubmit").attr("action", url);
        });

        $('#button_hasil').click(function() {
          var url = $(this).attr('data-url');
          $("#formSubmit").attr("action", url);
        });

        $('#button_status').click(function() {
          var url = $(this).attr('data-url');
          $("#formSubmit").attr("action", url);
        });
        $('input[name="tahun"]').daterangepicker({
                autoclose: true,
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
                
          });
      });
      
      </script>
  @endsection