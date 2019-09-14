<?php

use Illuminate\Database\Seeder;

class AlertSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'date' => '2019-09-13', 'score' => 98, 'type' => '2', 'controller_id' => 1, 'created_by_id' => 1,],
            ['id' => 3, 'date' => '2019-09-13', 'score' => 98, 'type' => '2', 'controller_id' => 1, 'created_by_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Alert::create($item);
        }
    }
}
