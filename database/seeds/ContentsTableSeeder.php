<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
        	'user_id' => '1',
        	'content' => 'Hello',
        ];
        DB::table('contents')->insert($param);
    }
}
