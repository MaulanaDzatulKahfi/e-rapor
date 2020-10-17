<style>
    table, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style>

<table>
    <tr>
        <td rowspan="2"><b>No</b></td>
        <td rowspan="2"><b>Nis</b></td>
        <td rowspan="2"><b>Nama</b></td>
        <td colspan="2"><b>PAI</b></td>
        <td colspan="2"><b>PPKN</b></td>
        <td colspan="2"><b>B. INDONESIA</b></td>
        <td colspan="2"><b>MATEMATIKA</b></td>
        <td colspan="2"><b>IPA</b></td>
        <td colspan="2"><b>IPS</b></td>
        <td colspan="2"><b>B. INGGRIS</b></td>
        <td colspan="2"><b>SENI BUDAYA</b></td>
        <td colspan="2"><b>PENJAS</b></td>
        <td colspan="2"><b>PRAKARYA</b></td>
    </tr>
    <tr>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
        <td>Nilai Keterampilan</td>
        <td>Deskripsi</td>
    </tr>
    @foreach($siswa as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s->nis }}</td>
            <td>{{ $s->nama_siswa }}</td>
        </tr>
    @endforeach
</table>
