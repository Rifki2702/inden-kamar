<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\IndenPasien;

class IndenChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $tanggal = [];
        $jumlahInden = [];

        // Mengambil data inden pasien per hari
        $indensPerHari = IndenPasien::selectRaw('DATE(tanggal_mrs) as tanggal, COUNT(*) as jumlah')
            ->whereDate('tanggal_mrs', '>', now())
            ->whereDate('tanggal_mrs', '<=', now()->addDays(7))
            ->groupBy('tanggal')
            ->get();

        foreach ($indensPerHari as $inden) {
            $tanggal[] = $inden->tanggal;
            $jumlahInden[] = $inden->jumlah;
        }

        return $this->chart->barChart()
            ->addData('Jumlah Inden', $jumlahInden)
            ->setXAxis($tanggal)
            ->setHeight(265); // Mengatur tinggi grafik menjadi 600 piksel
    }
}
