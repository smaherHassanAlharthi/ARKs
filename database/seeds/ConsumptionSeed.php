<?php

use Illuminate\Database\Seeder;

class ConsumptionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'liters' => 10, 'cost' => 50, 'date' => '2019-09-13',],
            ['id' => 3, 'liters' => 10, 'cost' => 50, 'date' => '2019-09-13',],

        ];

        foreach ($items as $item) {
            \App\Consumption::create($item);
        }
    }
}
