<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // DEVELOPMENT
        if(env('APP_ENV') == 'local')
        {
            $this->call(UserSeeder::class);
        }

        // PRODUCTION
        $this->call(SettingSeeder::class);
    }
}
