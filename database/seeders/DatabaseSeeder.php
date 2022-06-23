<?php

namespace Database\Seeders;

use App\Models\TripType;
use Carbon\Carbon;
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
        TripType::insert([
            ['name'=>'رحلة','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'فرح','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'جنازة','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'فعالية','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'مؤسسات','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'شركات','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'أخرى','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
