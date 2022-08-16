<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MostUsedPodChart
{
    const COMPANY_ID = 8;

    public function get()
    {
        $limit = 5;

        $podCounts = DB::table('requests')->select([
            DB::raw("count('*') as count"),
            "requests.port_of_discharge_id as pod_id",
            "ports.name as port_name"
        ])
            ->join('ports', 'ports.id', '=', 'requests.port_of_discharge_id')
            ->where('requests.company_id', '=', SELF::COMPANY_ID)
            ->groupBy('pod_id', 'port_name')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get();

        $labels = [];
        $values = [];

        for ($i = 0; $i < $podCounts->count(); $i++) {
            $labels[$i] = $podCounts[$i]->port_name;
            $values[$i] = $podCounts[$i]->count;
        }
        $dataset = [
            'label' => $labels,
            'value' => $values
        ];

        return $dataset;
    }
}
