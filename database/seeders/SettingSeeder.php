<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name' => 'TITLE',
                'value' => 'KickDDoS',
            ],
            [
                'name' => 'TITLE_SEPERATOR',
                'value' => '-',
            ],
            [
                'name' => 'FAVICON',
                'value' => NULL,
            ],
            [
                'name' => 'LOGO',
                'value' => NULL,
            ],
            [
                'name' => 'PAGINATION',
                'value' => '20',
            ],
            [
                'name' => 'MAIL_MAILER',
                'value' => 'smtp',
            ],
            [
                'name' => 'MAIL_HOST',
                'value' => 'host',
            ],
            [
                'name' => 'MAIL_PORT',
                'value' => 25,
            ],
            [
                'name' => 'MAIL_USERNAME',
                'value' => 'username',
            ],
            [
                'name' => 'MAIL_PASSWORD',
                'value' => 'password',
            ],
            [
                'name' => 'MAIL_ENCRYPTION',
                'value' => 'tls',
            ],
            [
                'name' => 'MAIL_FROM_ADDRESS',
                'value' => 'admin@example.com',
            ],
            [
                'name' => 'DESCRIPTION',
                'value' => 'KickDDoS',
            ],
            [
                'name' => 'INSTALLED',
                'value' => NULL,
            ],
        ]);
    }
}
