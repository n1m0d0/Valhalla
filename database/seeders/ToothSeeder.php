<?php

namespace Database\Seeders;

use App\Models\Tooth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 4; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $tooth = new Tooth();
                $tooth->quadrant = $i;
                $tooth->number = $j + (10 * $i);
                $tooth->save();
            }
        }

        for ($i = 5; $i <= 8; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                $tooth = new Tooth();
                $tooth->quadrant = $i;
                $tooth->number = $j + (10 * $i);
                $tooth->save();
            }
        }
    }
}
