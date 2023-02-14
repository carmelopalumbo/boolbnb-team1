<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = config('db.properties');

        foreach ($properties as $property) {
            $new_property = new Property();
            $new_property->user_id = rand(1, 5);
            $new_property->name = $property['name'];
            $new_property->slug = Property::slugGenerator($new_property->name);
            $new_property->size = $property['size'];
            $new_property->description = $property['description'];
            $new_property->cover_image = 'TEST';
            $new_property->rooms = $property['bedrooms'];
            $new_property->bathrooms = $property['bathrooms'];
            $new_property->beds = $property['beds'];
            $new_property->address = $property['address'];
            $new_property->latitude = 'TEST1';
            $new_property->longitude = 'TEST2';
            $new_property->price = $property['price'];
            $new_property->is_visible = true;
            $new_property->is_sponsored = false;

            //dump($new_property);

            $new_property->save();
        }
    }
}
