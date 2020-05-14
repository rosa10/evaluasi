@extends('layouts.app')
@section('page-title','User Management')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('admin/user/create ')}}" class="btn btn-primary my-2 ">Tambah Pengguna</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                  @include('partials.alerts')
                  <div class="pull-left">
                  <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                    Import Excel
                  </button>
                  </div>
                  <div class="pull-right">
                    
                    <!-- Date range -->
                    <form action="{{url('status')}}" method="post">
                      @csrf 
                      <div class="form-group">
                        <label for="dari"> Dari Tanggal </label>
                        <input type="date" name="dari" value="dd-mm-yyyy"> 
                        <label for="sampai">    Sampai Tanggal </label>
                        <input type="date" name="sampai" value="dd-mm-yyyy">		
                        <button type="submit" value="FILTER" class="btn btn-primary ">Cek Status</button>
                      </div>
                    </form>
                </div>
                  <!-- Import Excel -->
                  <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form method="post" action="{{url('/user/import_excel')}}" enctype="multipart/form-data">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                          </div>
                          <div class="modal-body">
               
                            {{ csrf_field() }}
               
                            <label>Pilih file excel</label>
                            <div class="form-group">
                              <input type="file" name="file" required="required">
                            </div>
               
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
               
               
                  
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Status</th>
                        <th scope="col"width="150px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{implode(', ',$user->roles()->get()->pluck('name')->toArray())}}</td>
                          <td>
                            @if ($user->status == 1)
                            sukses
                            @else
                            belum
                            @endif
                          </td>
                          <td>
                            <a href="{{url('admin/user/'.$user->id.'/edit')}}" class="btn btn-primary btn-sm mr-2">
                              Edit
                            </a>
                    
                            <button id="tombolHapusData"
                            class="btn btn-danger btn-sm delete-data"
                            data-name="{{ $user->name }}" data-toggle="modal"
                            data-target="#modalHapusData"
                            data-url="{{url('admin/user/'.$user->id)}}"><i
                                class="fa fa-trash"></i>
                            Delete
                        </button>
                          </td>
                          
                        </tr>
                      </tr>
                      @endforeach
                      <!-- Modal -->
                    <form action="" method="POST" id="deleteForm">
                      @method('delete')
                      @csrf
                      <div class="modal fade" id="modalHapusData" tabindex="-1" role="dialog"
                          aria-labelledby="hapusDataTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body" align="center">
                                      
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary"
                                          data-dismiss="modal">Batal</button>

                                      <button type="submit" class="btn btn-danger">Hapus</button>

                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
                  <!-- EndModal -->
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    {{-- Button Delete data  --}}
    <script>
      $(document).ready(function () {
          $('.delete-data').click(function () {
              var url = $(this).attr('data-url');
              var nama = $(this).attr('data-name');
              console.log(nama);
              $("#modalHapusData").find(".modal-body").text("Apakah anda ingin menghapus user " + nama + "?");
              $("#deleteForm").attr("action", url);
          });
      });
  </script>
@endsection