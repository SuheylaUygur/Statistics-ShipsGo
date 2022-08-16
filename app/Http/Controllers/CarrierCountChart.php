<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CarrierCountChart
{

    public function get()
    {
        $limit = 8;

        // son 6 ayda en çok kullanılan 8 carrier
        $carrier = DB::table('requests')->select([
            DB::raw("count('*') as count"),
            DB::raw("carriers.name as carrier_name")
        ])
            ->join('carriers', 'carrier_id', '=', 'carriers.id')
            ->where('requests.created_at', '>', now()->subMonths(5)->startOfMonth())
            ->groupBy('carrier_id')->orderBy('count', 'desc')->limit($limit)->get();

        $labels = [];
        $values = [];
        for ($i = 0; $i < $carrier->count(); $i++) {
            $labels[$i] = $carrier[$i]->carrier_name;
            $values[$i] = $carrier[$i]->count;
        }
        $dataset = [
            'label' => $labels,
            'value' => $values
        ];

        return $dataset;
    }
}
