@extends('layout.authTemplate')

@section('judul', 'Nilai')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <form action="/nilai/download/{{ Auth::user()->kelas_id }} }}" method="POST" class="form-inline">
                    @csrf
                    <div class="col-sm">
                        <select name="format" class="form-control">
                            <option value="sikap">Sikap Spiritual, Sosial dan Kehadiran</option>
                            <option value="nilai_pengetahuan">Nilai Pengetahuan</option>
                            <option value="nilai_keterampilan">Nilai Keterampilan</option>
                            <option value="nilai_eskul">Nilai Eskul</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Download Format</button>
                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#import">Import</a>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="siswa">
                            @foreach($nilai as $k)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $k->siswa->nama_siswa }}</td>
                                    <td>{{ $k->kelas->nama_kelas }}</td>
                                    <td>{{ $k->semester->tahun_ajaran }} / {{ $k->semester->nama_semester }}</td>
                                    <td>
                                        <a href="/nilai/pdf/{{ $k->id }}" class="badge badge-danger">PDF</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="import">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Form Import Nilai</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="import-form">
                <div class="modal-body">
                    @csrf
                    <div class="row form-group">
                        <div class="col-3">
                            <label for="nama">{{ __('Tipe import') }} </label>
                        </div>
                        <div class="col-9">
                            <select name="format" class="form-control" id="format">
                                <option value="tipe"> -- Tipe Import -- </option>
                                <option value="sikap">Sikap Spiritual, Sosial dan Kehadiran</option>
                                <option value="nilai_pengetahuan">Nilai Pengetahuan</option>
                                <option value="nilai_keterampilan">Nilai Keterampilan</option>
                                <option value="nilai_eskul">Nilai Eskul</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <label for="nis">{{ __('Pilih File') }} </label>
                        </div>
                        <div class="col-9">
                            <input type="file" name="{{ __('format') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">kembali</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#format').on('change', function(e){
                var id = e.target.value;
                console.log(id);
                if(id == 'sikap'){
                    $('#import-form').attr('action', 'nilai/import/sikap');
                }
                if(id == 'nilai_pengetahuan'){
                    $('#import-form').attr('action', 'nilai/import/nilai-pengetahuan');
                }
                if(id == 'nilai_keterampilan'){
                    $('#import-form').attr('action', 'nilai/import/nilai-keterampilan');
                }
                if(id == 'nilai_eskul'){
                    $('#import-form').attr('action', 'nilai/import/nilai-eskul');
                }
                if(id == 'tipe'){
                    $('#import-form').attr('action', '');
                }
            });
        });
    </script>
@endsection
