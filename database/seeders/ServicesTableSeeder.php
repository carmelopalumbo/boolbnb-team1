<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = config('db.services');

        foreach ($services as $service) {
            $new_service = new Service();
            $new_service->name = $service;

            $new_service->save();
        }
    }
}
