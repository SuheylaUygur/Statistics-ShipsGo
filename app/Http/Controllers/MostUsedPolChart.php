<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MostUsedPolChart
{
    const COMPANY_ID = 8;

    public function get()
    {

        $limit = 5;

        $polCounts = DB::table('requests')->select([
            DB::raw("count('*') as count"),
            "requests.port_of_loading_id as pol_id",
            "ports.name as port_name"
        ])
            ->join('ports', 'ports.id', '=', 'requests.port_of_loading_id')
            ->where('requests.company_id', '=', SELF::COMPANY_ID)
            ->groupBy('pol_id', 'port_name')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get();

        $labels = [];
        $values = [];

        for ($i = 0; $i < $polCounts->count(); $i++) {
            $labels[$i] = $polCounts[$i]->port_name;
            $values[$i] = $polCounts[$i]->count;
        }
        $dataset = [
            'label' => $labels,
            'value' => $values
        ];

        return $dataset;
    }
}
