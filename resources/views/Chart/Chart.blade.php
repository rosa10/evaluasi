@extends('layouts.app')

@section('page-title','Chart')

  @section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
        
      Halaman ini adalah untuk melihat hasil pengisian evaluasi dalam bentuk chart
       <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <form method="get" action="{{url('chart2')}}">
		@csrf
          <div class="form-group">
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
			<label for="kategori">Kategori</label>
			<select for="kategori_id" id="kategori_id" name="kategori_id" class="form-control" required>

				<option  selected disabled >
          Pilih Kategori
				</option>
			</select>
        </div>
        <div class="form-group">
                        <label for="dari"> Dari Tanggal </label>
                        <input type="date" name="dari" value="dd-mm-yyyy" required> 
                        <label for="sampai">    Sampai Tanggal </label>
                        <input type="date" name="sampai" value="dd-mm-yyyy" required>		
                      </div>
        <button type="submit" class="btn btn-primary">Lihat Chart</button>
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
      });
      </script>
  @endsection