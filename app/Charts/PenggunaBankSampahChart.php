<?php

namespace App\Charts;

use App\Models\PenggunaBankSampah;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class PenggunaBankSampahChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $data = PenggunaBankSampah::where('UserID', Auth::user()->id)->get();

        return $this->chart->pieChart()
            ->setTitle('Entah')
            ->setSubtitle('iya')
            ->addData([
                $data->where('jenis_sampah', 'Organik')->count(),
                $data->where('jenis_sampah', 'Anorganik')->count(),
            ])
            ->setLabels(['Organik', 'An-Organik']);
    }
}
