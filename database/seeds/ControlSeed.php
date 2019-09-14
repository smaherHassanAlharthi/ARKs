<?php

use Illuminate\Database\Seeder;

class ControlSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Bathroom 1', 'status' => 1, 'created_by_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Control::create($item);
        }
    }
}
