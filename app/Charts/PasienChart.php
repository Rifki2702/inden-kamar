<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\IndenPasien;

class PasienChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tanggal = [];
        $jumlahInputanPasien = [];

        // Mengambil data inputan pasien per hari
        $inputanPasienPerHari = IndenPasien::selectRaw('DATE(tanggal_input) as tanggal, COUNT(*) as jumlah')
            ->where('tanggal_input', '>=', now()->subDays(7)->toDateString())
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        foreach ($inputanPasienPerHari as $inputan) {
            $tanggal[] = $inputan->tanggal;
            $jumlahInputanPasien[] = round($inputan->jumlah);
        }

        return $this->chart->lineChart()
            ->setTitle('Jumlah pasien yang diinput setiap hari')
            ->addData('Jumlah Pasien', $jumlahInputanPasien)
            ->setXAxis($tanggal);
    }
}
