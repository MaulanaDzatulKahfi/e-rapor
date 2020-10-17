{{-- <style>
    table, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style> --}}

<table>
    <tr>
        <td rowspan="2"><b>No</b></td>
        <td rowspan="2"><b>Nis</b></td>
        <td rowspan="2"><b>Nama</b></td>
        <td colspan="2"><b>Sikap</b></td>
        <td colspan="3"><b>Kehadiran</b></td>
    </tr>
    <tr>
        <td><b>Spiritual</b></td>
        <td><b>Sosial</b></td>
        <td><b>Sakit</b></td>
        <td><b>Izin</b></td>
        <td><b>Tanpa Keterangan</b></td>
    </tr>
    @foreach($siswa as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s->nis }}</td>
            <td>{{ $s->nama_siswa }}</td>
        </tr>
    @endforeach
</table>
