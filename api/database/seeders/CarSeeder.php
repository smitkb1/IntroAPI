<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $json_file = File::get('database/data/car-data.json');
        DB::table('cars')->delete();
        $data = json_decode($json_file);
        foreach ($data as $obj) {
            car::create(array(
                'name' => $obj->name,
                'year' => $obj->year,
                'price' => $obj->price,
            ));
        } 
    }
}
