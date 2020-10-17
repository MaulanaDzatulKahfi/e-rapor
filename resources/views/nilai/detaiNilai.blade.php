@extends('layout.authTemplate')

@section('judul', 'Nilai')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Nilai Raport</div>
                </div>
                    Nama : {{ $nilai->siswa->nama_siswa }}
                    Nis : {{ $nilai->siswa->nis }}
                    kelas : {{ $nilai->kelas->nama_kelas }}
                    semester : {{ $nilai->semester->nama_semester }}
                    tahun pelajaran : {{ $nilai->semester->tahun_ajaran }}
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Mata Pelajaran</td>
                                <td>Nilai Pengetahuan</td>
                                <td>Nilai keterampilan</td>
                                <td>desk pengetahuan</td>
                                <td>desk keterampilan</td>
                                <td>desk spiritual</td>
                                <td>deskripsi</td>
                            </tr>
                        </thead>
                            @foreach ($n_pelajaran as $n)
                        <tr>
                            <td>{{ $n->pelajaran->nama_pelajaran }}</td>
                            <td>{{ $n->nilai_pengetahuan }}</td>
                            <td>{{ $n->nilai_keterampilan }}</td>
                            <td>{{ $n->desk_pengetahuan }}</td>
                            <td>{{ $n->desk_keterampilan }}</td>
                            <td>{{ $n->desk_spiritual }}</td>
                            @endforeach
                            <td>{{ $nilai->deskripsi }}</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>eskul</td>
                            <td>nilai</td>
                            <td>keterangan</td>
                        </tr>
                        @foreach ($eskul as $e)
                            <tr>
                                <td>{{ $e->eskul->nama_eskul }}</td>
                                <td>{{ $e->nilai_eskul }}</td>
                                <td>{{ $e->keterangan }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
