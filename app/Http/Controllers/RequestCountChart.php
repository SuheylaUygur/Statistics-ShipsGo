<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RequestCountChart
{

    public function get()
    {
        //son 6 aydaki request sayıları ( ay ay değişimi )
        $req = DB::table("requests")
            ->select(
                DB::raw("count(*) as count"),
                DB::raw("date_format(created_at,  '%Y-%m') as period")
            )
            ->where('created_at', '>', now()->subMonths(5)->startOfMonth())
            ->groupBy('period')
            ->get();

        $labels = [];
        $values = [];
        for ($i = 0; $i < $req->count(); $i++) {
            $labels[$i] = $req[$i]->period;
            $values[$i] = $req[$i]->count;
        }

        $dataset = [
            'label' => $labels,
            'value' => $values
        ];

        return $dataset;
    }
}
