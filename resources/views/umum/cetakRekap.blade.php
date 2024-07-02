<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Rekap Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px; /* menambahkan ruang antara isi sel dengan batas */
            text-align: left;
            word-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
        @media print {
            th, td {
                padding: 6px; 
                font-size: 9px; 
            }
            h1 {
                font-size: 16px; 
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rekap Peminjaman</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Tanggal</th>
                    <th>Gedung</th>
                    <th>Ruangan</th>
                    <th>Acara</th>
                    <th>Jumlah Peserta</th>
                    <th>Nasi Box</th>
                    <th>Snack</th>
                    <th>Prasmanan</th>
                    <th>Konsumsi</th>
                    <th>Video Conference</th>
                    <th>Proyektor</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $index => $pinjam)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pinjam->nip }}</td>
                    <td>{{ $pinjam->tanggal}}</td>
                    <td>{{ $pinjam->nama_gedung }}</td>
                    <td>{{ $pinjam->nama_ruangan }}</td>
                    <td>{{ $pinjam->acara }}</td>
                    <td>{{ $pinjam->jumlah_peserta }}</td>
                    <td>{{ $pinjam->nasi_box }}</td>
                    <td>{{ $pinjam->snack }}</td>
                    <td>{{ $pinjam->prasmanan }}</td>
                    <td>{{ $pinjam->konsumsi }}</td>
                    <td>{{ $pinjam->vicon }}</td>
                    <td>{{ $pinjam->proyektor }}</td>
                    <td>{{ $pinjam->catatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        window.print()
    </script>
</body>
</html>
