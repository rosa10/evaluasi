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
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
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