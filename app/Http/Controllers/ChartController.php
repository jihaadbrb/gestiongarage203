<?php

namespace App\Http\Controllers;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ChartController extends Controller
{
    public function index()
    {
        // Fetch data from database, API, or other sources
        $data = [
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            'series' => [
                [
                    'name' => 'Sales',
                    'data' => [30, 40, 45, 50, 49],
                ],
            ],
        ];

        // Create ApexChart instance and configure options
        $chart = (new LarapexChart)
            ->setType('line') // Or any other ApexChart type (bar, area, etc.)
            ->setTitle('Sales Trend')
            ->setSubtitle('2024')
            ->setXAxis($data['categories'])
            ->setSeries($data['series']);

        return view('chart', compact('chart'));
    }
}
