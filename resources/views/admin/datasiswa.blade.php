@extends('layout.AuthTemplate')

@section('judul', 'Data Siswa')

@section('content')
    @if(Auth::user()->level == 'admin')
        <div class="row mb-3">
            <div class="col-xs-3">
                <h5><strong class="ml-3">Pilih Kelas:  </strong><h5>
            </div>
            <div class="col-lg-3">
                <select name="kelas" id="kelas" class="form-control">
                    <option value="0">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(Auth::user()->level == 'admin')
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <p class="card-title">
                                    Wali Kelas: <strong id="walikelas"><strong>
                                </p>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama</th>
                                @if(Auth::user()->level == 'admin')
                                <th>Aksi</th>
                                @endif
                            </tr>
                            @if(Auth::user()->level == 'walikelas')
                                @foreach($siswa as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->nis }}</td>
                                        <td>{{ $s->nama_siswa }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </thead>
                        <tbody id="siswa">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->level == 'admin')
    <!-- modal tambah-->
    <div class="modal fade" id="tambah">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Form Tambah Siswa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ url('/tambahsiswa') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row form-group">
                        <div class="col-3">
                            <label for="nama">{{ __('Nama') }} </label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="{{ __('nama_siswa') }}" class="form-control @error('nama_siswa') is-invalid @enderror">
                            @error('nama_siswa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <label for="nis">{{ __('Nis') }} </label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="{{ __('nis') }}" class="form-control @error('nis') is-invalid @enderror">
                            @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <label for="kelas">{{ __('Kelas') }} </label>
                        </div>
                        <div class="col-9">
                            <select name="{{ __('kelas_id') }}" class="form-control @error('kelas_id') is-invalid @enderror">
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">kembali</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- modal edit-->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Form Edit Siswa</h4>
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
                                <label for="nis">{{ __('Nis') }} </label>
                            </div>
                            <div class="col-9">
                                <input id="modal-input-nis" name="{{ __('nisuser') }}" type="number" class="form-control @error('nis') is-invalid @enderror" readonly>
                                @error('nisuser')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-3">
                                <label for="nama">{{ __('Nama') }} </label>
                            </div>
                            <div class="col-9">
                                <input id="modal-input-nama" type="text" name="{{ __('nama') }}" class="form-control @error('nama') is-invalid @enderror">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-3">
                                <label for="kelas">{{ __('Kelas') }} </label>
                            </div>
                            <div class="col-9">
                                <select id="modal-input-kelas" name="{{ __('kelas') }}" class="form-control @error('kelas') is-invalid @enderror">
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">kembali</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endif
@endsection

@section('script')
{{-- view siswa --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#kelas').on('change', function(e){
                var id = e.target.value;
                if(id == '0'){
                    $.get('{{ url('/') }}');
                }
                $.get('{{ url('cari')}}/'+id, function(data){
                    $('#siswa').empty();
                    $('#walikelas').empty();
                    var no = 1;
                    $.each(data, function(index, element){
                        $('#siswa').append(`
                            <tr>
                                <td>`+ no++ +`</td>
                                <td>`+ element.nis +`</td>
                                <td>`+ element.nama_siswa +`</td>
                                <td>
                                    <form action="hapussiswa/`+element.id+`" method="post">
                                    <a class="badge badge-warning" id="edit-item" data-item-id="`+element.id+`"><i class="fas fa-edit"></i> Edit</a>
                                        @method('delete')
                                        @csrf
                                        <button type="submit" id="hapus" class="badge badge-danger"><i class="fas fa-trash" onclick="return confirm('apa anda yakin? data dihapus?')"></i> Hapus</button>
                                    </form
                                </td>
                            </tr>
                        `);
                    });
                    $('#walikelas').append(data[0].walikelas);
                });
            });
        });
    </script>
        {{-- feedbak error tambah --}}
        @if($errors->has('nama_siswa') || $errors->has('nis') || $errors->has('kelas_id'))
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

            $.get('{{ url('editsiswa')}}/'+id, function(data){
                $("#modal-input-nama").val(data.nama_siswa);
                $("#modal-input-nis").val(data.nis);
                $("#modal-input-kelas").val(data.kelas_id);
                $('#edit-form').attr('action', '{{ url('updatesiswa') }}/'+data.id);
            });
        });
        // on modal hide
        $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        });
    </script>
@endsection
