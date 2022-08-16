<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RequestCountChart;
use App\Http\Controllers\CarrierCountChart;


class TrackingStaticsController extends Controller
{
    public function __invoke()
    {
        return [
            'charts' => [
                (new RequestCountChart)->get(),
                (new CarrierCountChart)->get(),
                (new MostUsedPolChart)->get(),
                (new MostUsedPodChart)->get(),
            ]
        ];
    }
}
