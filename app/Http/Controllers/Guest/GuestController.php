<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use stdClass;

use function GuzzleHttp\Promise\is_settled;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();

        $query = Property::query()->with('services');
        if ($request['search']) {
            $query->when($request['search'], function ($q, $request) {
                $q->where('address', 'like', '%' . $request . '%');
            })
                ->when($request['beds'], function ($q, $request) {
                    $q->where('beds', '>=', $request);
                })
                ->when($request['rooms'], function ($q, $request) {
                    $q->where('rooms', '>=', $request);
                })
                ->when($request['filterServices'], function ($q, $request) {

                    $q->whereHas('services', function ($temp) use ($request) {
                        $temp->whereIn('service_id', $request);
                    });
                });

            $properties = $query->get();
            //dd($properties[6]->services()->get()->toArray());
        } else {
            $properties = Property::all();
        }

        return Inertia::render('Guest/Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'properties' => $properties,
            'services' => $services,
        ]);
    }
}

//find(118)->services()->get()
//find(118)->services()->first();
