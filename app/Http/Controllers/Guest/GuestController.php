<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function GuzzleHttp\Promise\is_settled;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();
        // dd($request->all());
        // if(array_key_exists('filterServices', $request->all())){
        //     $serviceProperty = implode($request['filterServices']);
        //     dd($serviceProperty);
        // }
        $query = Property::query();
        if($request['search']){
            $query->when($request['search'], function($q, $request) {
                $q->where('address', 'like', '%' . $request . '%');
            })
            ->when($request['beds'], function($q, $request) {
                $q->where('beds', '>=', $request);
            })
            ->when($request['rooms'], function($q, $request) {
                $q->where('rooms', '>=', $request);
            });
            $properties = $query->get();

        }else{
            $properties = Property::all();
        }



        return Inertia::render('Guest/Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'properties'=> $properties,
            'services' => $services,
        ]);
    }

}
