<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->insert([
    		'name' => 'admin',
    		'created_at' => new DateTime,
    		'updated_at' => new DateTime
    	],
    	[
    		'name' => 'member',
    		'created_at' => new DateTime,
    		'updated_at' => new DateTime
    	],
    	[
    		'name' => 'user',
    		'created_at' => new DateTime,
    		'updated_at' => new DateTime
    	]
    );
    }
}
