<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyVisits
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($counts): array
    {
        return $this->chart->pieChart()
            ->setTitle('Visite mensili')
            ->setSubtitle('Anno 2023')
            ->addData([$counts['01'], $counts['02'], $counts['03'], $counts['04'], $counts['05'], $counts['06'], $counts['07'], $counts['08'], $counts['09'], $counts[10], $counts[11], $counts[12]])
            ->setLabels(['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'])
            ->toVue();
    }
}
