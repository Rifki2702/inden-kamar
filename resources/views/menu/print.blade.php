<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Cetak Data</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css')}}" rel="stylesheet" />

    <link href="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        body,
        p,
        h2,
        th,
        td {
            color: black !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <h4 class="mb-1"><strong>RSUD Haji Provinsi Jawa Timur</strong></h4>
            <p class="mb-1">Jl. Manyar Kertoadi, Klampis Ngasem, Sukolilo, Surabaya, Jawa Timur</p>
            <p class="mb-4">Telp : 031-592-4000, Fax : 031 – 5947890 hukmasrsuhaji@gmail.com e-Mail : hukmasrsuhaji@gmail.com</p>
        </div>
        <table class="table table-striped small text-center" id="dataTable" width="100%">
            <thead>
                <tr>
                    <th>No RM</th>
                    <th>Nama Pasien</th>
                    <th>No Telepon</th>
                    <th>Diagnosa</th>
                    <th>DPJP</th>
                    <th>Kelas Perawatan</th>
                    <th>Tanggal MRS</th>
                    <th>Ruang</th>
                    <th>Bed</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->no_rm }}</td>
                    <td>{{ $item->nama_pasien }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>{{ $item->diagnosa }}</td>
                    <td>{{ $item->dpjp }}</td>
                    <td>{{ $item->kelas_perawatan }}</td>
                    <td>{{ $item->tanggal_mrs }}</td>
                    <td>{{ $item->ruang }}</td>
                    <td>{{ $item->bed }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>