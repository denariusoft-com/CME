<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
      //  $this->call(CountriesTableSeeder::class);
      /*  $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class); */
    }
}
