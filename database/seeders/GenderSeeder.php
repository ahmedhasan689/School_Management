<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->truncate();

        $names = [
            ['en' => 'Male', 'ar' => 'ذكر'],
            ['en' => 'Female', 'ar' => 'أنثى']
        ];

        foreach ($names as $name){
            Gender::create([
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
