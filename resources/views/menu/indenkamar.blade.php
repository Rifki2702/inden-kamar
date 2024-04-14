@extends('layout.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mb-2">
            <button class="btn btn-sm btn-primary shadow-sm position-left" data-toggle="modal" data-target="#insert">
                <i class="fas fa-plus fa-sm text-white-50"></i> Input Inden
            </button>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#printModal"><i class="fas fa-print"></i>
                Cetak Data
            </button>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-1 text-gray-900"><strong>Inden Pasien</strong></div>
        <div class="card-body">
            <!-- Flash message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
            @endif
            @if(session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped small text-center" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>No Telepon</th>
                            <th>Tanggal MRS</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($indenPasien as $key => $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->no_rm }}</td>
                            <td>{{ $data->nama_pasien }}</td>
                            <td>{{ $data->no_telepon }}</td>
                            <td>{{ $data->tanggal_mrs }}</td>
                            <td>
                                <form action="{{ route('admin.updateStatus', ['id' => $data->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="@if($data->status == 'batal') badge badge-danger @elseif($data->status == 'selesai') badge badge-success btn-sm @else badge badge-warning btn-sm @endif">
                                        <option value="batal" {{ $data->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                        <option value="proses" {{ $data->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="action-buttons d-flex justify-content-center">
                                    <div class="mx-1">
                                        <button type="button" class="btn btn-primary btn-sm btn-icon-text" data-toggle="modal" data-target="#editModal{{ $data->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                    <div class="mx-1">
                                        <form action="{{ route('admin.deletedata', ['id' => $data->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $data->nama_pasien }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary btn-sm btn-icon-text" onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $data->nama_pasien }}?');">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('admin.updateinden', ['id' => $data->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label for="edit_no_rm" class="col-sm-4 col-form-label">Nomor RM</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="edit_no_rm" name="no_rm" min="000001" max="9999999" pattern="[0-9]*" placeholder="Nomor Rekam Medis" required value="{{ $data->no_rm }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_nama_pasien" class="col-sm-4 col-form-label">Nama Pasien</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="edit_nama_pasien" name="nama_pasien" placeholder="Nama Lengkap Pasien" required value="{{ $data->nama_pasien }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_no_telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="edit_no_telepon" name="no_telepon" placeholder="Nomor Telepon" required value="{{ $data->no_telepon }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_no_telepon1" class="col-sm-4 col-form-label"></label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="edit_no_telepon1" name="no_telepon1" placeholder="Nomor Telepon" required value="{{ $data->no_telepon1 }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_diagnosa" class="col-sm-4 col-form-label">Diagnosa</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="edit_diagnosa" name="diagnosa" placeholder="Diagnosa" required value="{{ $data->diagnosa }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_dpjp" class="col-sm-4 col-form-label">Dokter</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="edit_dpjp" name="dpjp" placeholder="Dokter Penanggungjawab" required value="{{ $data->dpjp }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_kelas_perawatan" class="col-sm-4 col-form-label">Kelas Perawatan</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="edit_kelas_perawatan" name="kelas_perawatan" required>
                                                        <option selected>Pilih Kelas Perawatan</option>
                                                        <option value="1" {{ $data->kelas_perawatan == '1' ? 'selected' : '' }}>1</option>
                                                        <option value="2" {{ $data->kelas_perawatan == '2' ? 'selected' : '' }}>2</option>
                                                        <option value="3" {{ $data->kelas_perawatan == '3' ? 'selected' : '' }}>3</option>
                                                        <option value="VIP" {{ $data->kelas_perawatan == 'VIP' ? 'selected' : '' }}>VIP</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_dpjp" class="col-sm-4 col-form-label">Ruang</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="edit_ruang" name="ruang" placeholder="Ruang" required value="{{ $data->ruang }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_dpjp" class="col-sm-4 col-form-label">Bed</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="edit_bed" name="bed" placeholder="Bed" required value="{{ $data->bed }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edit_tanggal_mrs" class="col-sm-4 col-form-label">Tanggal MRS</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="edit_tanggal_mrs" name="tanggal_mrs" placeholder="Tanggal MRS" required value="{{ $data->tanggal_mrs }}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal insert -->
    <div class="modal fade" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.insertinden') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="rm" class="col-sm-4 col-form-label">Nomor RM</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="rm" min="000001" max="9999999" pattern="[0-9]*" placeholder="Nomor Rekam Medis" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama Pasien</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap Pasien" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="telepon" placeholder="Nomor Telepon" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="telepon1" placeholder="Nomor Telepon" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diagnosa" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="diagnosa" placeholder="Diagnosa" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dpjp" class="col-sm-4 col-form-label">Dokter</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="dpjp" placeholder="Dokter Penanggungjawab" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-4 col-form-label">Kelas Perawatan</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="kelas" required>
                                    <option selected>Pilih Kelas Perawatan</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="VIP">VIP</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-4 col-form-label">Tanggal MRS</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="mrs" placeholder="Tanggal MRS" required>
                            </div>
                        </div>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal cetak sesuai tanggal -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">Cetak Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="printForm">
                        <div class="form-group">
                            <label for="tanggal">Tanggal:</label>
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="date" class="form-control" name="start" />
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">to</span>
                                </div>
                                <input type="date" class="form-control" name="end" />
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnPrint">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="{{ !empty($data->id) ? route('admin.updateinden', ['id' => $data->id]) : '#' }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="rm" class="col-sm-4 col-form-label">Nomor RM</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_rm" min="000001" max="9999999" pattern="[0-9]*" placeholder="Nomor Rekam Medis" required value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama Pasien</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_pasien" placeholder="Nama Lengkap Pasien" required value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_telepon" placeholder="Nomor Telepon" required value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_telepon1" placeholder="Nomor Telepon" required value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diagnosa" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="diagnosa" placeholder="Diagnosa" required value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dpjp" class="col-sm-4 col-form-label">Dokter</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="dpjp" placeholder="Dokter Penanggungjawab" required value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas_perawatan" class="col-sm-4 col-form-label">Kelas Perawatan</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="kelas_perawatan" required>
                                    <option selected>Pilih Kelas Perawatan</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="VIP">VIP</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-4 col-form-label">Tanggal MRS</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="tanggal_mrs" placeholder="Tanggal MRS" required value="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection