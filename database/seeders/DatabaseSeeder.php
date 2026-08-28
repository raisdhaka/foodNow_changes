<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        if (! config('settings.makePureSaaS', false)) {
            $this->call(StatusTableSeeder::class);
        }

        $this->call(PagesSeeder::class);

        if (config('app.isqrsaas')&&config('settings.app_code_name')=='rpro') {
            $this->call(RporSeeder::class);
        }

        if(!config('settings.is_demo',false)){
            return;
        }

        //The demo seader
        $this->call(DemoSeeder::class);
        
    }
}
