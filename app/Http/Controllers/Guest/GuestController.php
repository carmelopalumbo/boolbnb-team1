<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Service;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Faker\Generator as Faker;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->all());
        if (array_key_exists('radius', $request->all())) {
            $radius = $request['radius'];
        } else {
            $radius = 20;
        }

        $services = Service::all();
        $query = Property::query()->with('services');
        if (!empty($request['search'])) {
            $query->when($request->all(), function ($q, $request) use ($radius) {
                $lat = $request['lat'];
                $lon = $request['lon'];
                $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lon)) + sin(radians($lat)) * sin(radians(latitude))))";
                $q->selectRaw("*, $haversine AS distance")
                    ->whereRaw("$haversine < ?", [$radius]);
            })
                ->when($request['beds'], function ($q, $request) {
                    $q->where('beds', '>=', $request);
                })
                ->when($request['rooms'], function ($q, $request) {
                    $q->where('rooms', '>=', $request);
                })
                ->when($request['filterServices'], function ($q, $request) {
                    foreach ($request as $item) {
                        $q->whereHas('services', function ($temp) use ($item) {
                            $temp->where('service_id', $item);
                        });
                    }
                });

            $properties = $query->where('is_visible', true)->paginate(9);
        } else {
            $properties = Property::where('is_sponsored', true)->paginate(9);
        }

        return Inertia::render('Guest/Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'properties' => $properties,
            'services' => $services,
        ]);
    }

    public function show($id, Faker $faker)
    {
        $property = Property::where('id', $id)->first();
        Stat::create([
            'ip_address' => $faker->ipv4(),
            'property_id' => $property->id
        ]);
        return Inertia::render('Guest/PropertyDetail', compact('property'));
    }
}
