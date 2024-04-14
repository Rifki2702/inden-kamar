<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\IndenPasien;

class StatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $IndenPasien = IndenPasien::all();
        $data = [
            $IndenPasien->where('status', 'batal')->count(),
            $IndenPasien->where('status', 'proses')->count(),
            $IndenPasien->where('status', 'selesai')->count(),
        ];
        $label = [
            'status batal',
            'status proses',
            'status selesai',
        ];

        return $this->chart->pieChart()
            ->addData($data)
            ->setLabels($label)
            ->setColors(['#FF5733', '#FFFF33', '#33FF57']);
    }
}
