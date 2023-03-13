<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $treatment = new Treatment();
        $treatment->name = "Curacion";
        $treatment->description = "Curar las caries";
        $treatment->price = 50.50;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Extraccion";
        $treatment->description = "Extraccion";
        $treatment->price = 50.50;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Conductos";
        $treatment->description = "Conductos";
        $treatment->price = 50.50;
        $treatment->save();
    }
}
