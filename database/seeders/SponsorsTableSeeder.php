<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = config('db.sponsors');

        foreach ($sponsors as $sponsor) {
            $new_sponsor = new Sponsor();
            $new_sponsor->name = $sponsor['name'];
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->duration = $sponsor['duration'];

            $new_sponsor->save();
        }
    }
}
