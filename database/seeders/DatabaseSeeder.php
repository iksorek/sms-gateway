<?php

namespace Database\Seeders;

use App\Models\Sms;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Marek Rogon',
            'email' => 'iksorek@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '07533078790',
            'mobile_verified_at' => now(),

            'password' => bcrypt('passwd'),


        ]);
        User::all()->each(function (User $user) {
          $sms = Sms::factory()->count(20)->make();
           $user->sms()->saveMany($sms);
        });
    }
}
