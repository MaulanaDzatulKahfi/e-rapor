@extends('layout.authTemplate')

@section('judul', 'Mata Pelajaran')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <p class="card-title">
                                <strong><strong>
                            </p>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelajaran</th>
                                <th>Kelompok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="siswa">
                            @foreach($pelajaran as $k)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $k->nama_pelajaran }}</td>
                                    <td>{{ $k->kelompok }}</td>
                                    <td>
                                        <form action="/pelajaran/hapus/{{ $k->id }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <a class="badge badge-warning" id="edit-item" data-item-id="{{ $k->id }}">Edit</a>
                                            <button type="submit" class="badge badge-danger" onclick="return confirm('yakin? Pelajaran dihapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- modal tambah-->
    <div class="modal fade" id="tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Form Tambah Pelajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ url('/pelajaran/tambah') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row form-group">
                            <div class="col-3">
                                <label for="nama_pelajaran">{{ __('Pelajaran') }} </label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="{{ __('nama_pelajaran') }}" class="form-control @error('nama_pelajaran') is-invalid @enderror">
                                @error('nama_pelajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-3">
                                <label for="kelompok">{{ __('Kelompok') }} </label>
                            </div>
                            <div class="col-9">
                                <select name="kelompok" class="form-control @error('kelompok') is-invalid @enderror">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                                @error('kelompok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">kembali</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Form Edit Pelajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="edit-form" method="POST">
                    <div class="modal-body">
                        @method('put')
                        @csrf
                        <div class="row form-group">
                            <div class="col-3">
                                <label for="nama_pelajaran">{{ __('Pelajaran') }} </label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="modal-input-pelajaran" name="{{ __('nama_pelajaran') }}" class="form-control @error('nama_pelajaran') is-invalid @enderror">
                                @error('nama_pelajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-3">
                                <label for="kelompok">{{ __('Kelompok') }} </label>
                            </div>
                            <div class="col-9">
                                <select id="modal-input-kelompok" name="kelompok" class="form-control @error('kelompok') is-invalid @enderror">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                                @error('kelompok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">kembali</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- feedbak error tambah --}}
    @if($errors->has('nama_pelajaran'))
        <script>
            $(function() {
                $('#tambah').modal({
                    show: true
                });
            });
        </script>
    @endif

    {{-- view edit --}}
    <script>
        $(document).ready(function() {
           $(document).on('click', "#edit-item", function() {
               $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
               var options = {
               'backdrop': 'static'
               };
               $('#edit-modal').modal(options);
           });
        });
        // on modal show
       $('#edit-modal').on('show.bs.modal', function() {
           var el = $(".edit-item-trigger-clicked");
           var id = el.data('item-id');

           $.get('pelajaran/edit/'+id, function(data){
               console.log(data);
               $("#modal-input-pelajaran").val(data.nama_pelajaran);
               $("#modal-input-kelompok").val(data.kelompok);
               $('#edit-form').attr('action', '{{ url('pelajaran/update') }}/'+data.id);
           });
       });
       // on modal hide
       $('#edit-modal').on('hide.bs.modal', function() {
           $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
           $("#edit-form").trigger("reset");
       });
   </script>
@endsection
