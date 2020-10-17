<style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }


</style>

<table>
    <tr class="center">
        <td rowspan="2">No</td>
        <td rowspan="2">MATA PELAJARAN</td>
        <td colspan="3">Pengetahuan</td>
    </tr>
    <tr class="tengah">
        <td>Nilai</td>
        <td>Predikat</td>
        <td>Deskripsi</td>
    </tr>
    <tr>
        <td colspan="2">Kelompok A</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tr>
        @php $no=1; @endphp
        @foreach($n_pengetahuan as $n)
            @php
            if ($n->nilai_pengetahuan >= 93) {
                $predikat = 'A';
            }elseif ($n->nilai_pengetahuan >= 84) {
                $predikat = 'B';
            }elseif ($n->nilai_pengetahuan >= 75) {
                $predikat = 'C';
            }else{
                $predikat = 'D';
            }
            @endphp
            @if($n->pelajaran->kelompok == 'A')
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $n->pelajaran->nama_pelajaran }}</td>
                    <td>{{ $n->nilai_pengetahuan }}</td>
                    <td>{{ $predikat }}</td>
                    <td>{{ $n->deskripsi_pengetahuan }}</td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td colspan="2">Kelompok B</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach($n_pengetahuan as $n)
            @php
                if ($n->nilai_pengetahuan >= 93) {
                    $predikat = 'A';
                }elseif ($n->nilai_pengetahuan >= 84) {
                    $predikat = 'B';
                }elseif ($n->nilai_pengetahuan >= 75) {
                    $predikat = 'C';
                }else{
                    $predikat = 'D';
                }
            @endphp
            @if($n->pelajaran->kelompok == 'B')
                <tr>
                    <td>{{ $no++}} </td>
                    <td>{{ $n->pelajaran->nama_pelajaran }}</td>
                    <td>{{ $n->nilai_pengetahuan }}</td>
                    <td>{{ $predikat }}</td>
                    <td>{{ $n->deskripsi_pengetahuan }}</td>
                </tr>
            @endif
        @endforeach
</table>

