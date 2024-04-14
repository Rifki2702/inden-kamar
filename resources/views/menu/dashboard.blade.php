@extends('layout.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Selamat Datang {{ Auth::user()->name }}</h5>
                <p class="card-text">Total semua pasien yang terdaftar sebanyak {{ $totalPasien }}</p>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <!-- Area Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Inden Pasien
                        </h6>
                    </div>
                    <div class="card-body">
                        {!! $PasienChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Pesanan Kamar Mendatang
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {!! $IndenChart->container() !!}
                    </div>
                </div>
            </div>
            <!-- Donut Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Status Inden Kamar
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {!! $StatusChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{ $StatusChart->cdn() }}"></script>
{{ $StatusChart->script() }}
<script src="{{ $PasienChart->cdn() }}"></script>
{{ $PasienChart->script() }}
<script src="{{ $IndenChart->cdn() }}"></script>
{{ $IndenChart->script() }}
@endsection