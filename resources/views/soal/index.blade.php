@extends('layouts/app')
@section('title','Edit Evaluasi ITK')
@section('page-title','Pertanyaan')
@section('content')
<div class="box">
    <div class="box-header with-border">
      <a href="{{url('soal/create')}}" class="btn btn-primary my-2 ">Tambah Pertanyaan</a>
            <div class="box-tools pull-right">
            </div></div>
                <div class="box-body">
                   <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Pertanyaan</th>
                        <th width="200px" scope="col">Pilihan</th>
						            <th scope="col"width="160px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      

                        @foreach($soal as $soal)
                        <tr>
                          {{-- @if ($soal->layanan_id==$layanan->where('user_id',Auth::user()->id)->implode('id')) --}}
                        <th>{{$loop->iteration}}</th>
                          <th>
                            {{$layanan->where('id',$soal->layanan_id)->implode('layanan')}}
                          </th>
                          <th>{{$soal->soal}}</th>
                          <th>
                            {{implode(', ',$soal->pilihan()->get()->pluck('pilihan')->sort()->toArray())}}
                          </th>
                          
                          <th>
                            <a href="{{url(route('soal.edit',$soal->id))}}" class="btn btn-primary btn-sm mr-2">
                              Edit
                            </a>
                            
                            <button id="tombolHapusData"
                                    class="btn btn-danger btn-sm delete-data"
                                    data-name="{{ $soal->soal }}" data-toggle="modal"
                                    data-target="#modalHapusData"
                                    data-url="{{url('soal/'.$soal->id)}}"><i
                                        class="fa fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                          </th>
                          {{-- @endif --}}
                        </tr>
                        {{-- @endif --}}
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
              $("#modalHapusData").find(".modal-body").text("Apakah anda ingin menghapus pertanyaan " + nama + "?");
              $("#deleteForm").attr("action", url);
          });
      });
  </script>
@endsection