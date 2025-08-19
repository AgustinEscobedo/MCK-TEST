<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Estado;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withOptions(['verify' => false])
            ->get('https://gaia.inegi.org.mx/wscatgeo/mgee/');


        $data = $response->json('datos');

        foreach ($data as $item) {
            Estado::create([
                'cvegeo' => $item['cvegeo'],
                'cve_agee' => $item['cve_agee'],
                'nom_agee' => $item['nom_agee'],
                'nom_abrev' => $item['nom_abrev'],
                'pob' => $item['pob'],
                'pob_fem' => $item['pob_fem'],
                'pob_mas' => $item['pob_mas'],
                'viv' => $item['viv'],
            ]);
        }
    }
}
