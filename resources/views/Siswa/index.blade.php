@extends('layout.template')

@section('judul', 'Data Siswa')

@section('content')
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <p class="card-title">
                                Wali Kelas: <strong id="walikelas"><strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody id="siswa">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#kelas').on('change', function(e){
                var id = e.target.value;
                if(id == '0'){
                    $.get('{{ url('/') }}');
                }
                $.get('{{ url('cari')}}/'+id, function(data){
                    console.log(data);
                    $('#siswa').empty();
                    $('#walikelas').empty();
                    var no = 1;
                    $.each(data, function(index, element){
                        $('#siswa').append(`
                            <tr>
                                <td>`+ no++ +`</td>
                                <td>`+ element.nis +`</td>
                                <td>`+ element.nama_siswa +`</td>
                            </tr>
                        `);
                    });
                    $('#walikelas').append(data[0].walikelas);
                });
            });
        });
    </script>
    {{-- <script>
    $(function () {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script> --}}
@endsection



