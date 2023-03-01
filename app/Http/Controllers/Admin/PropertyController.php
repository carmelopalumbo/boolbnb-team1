<?php

namespace App\Http\Controllers\Admin;

use App\Charts\MonthlyMessages;
use App\Charts\MonthlyVisits;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Message;
use App\Models\Property;
use App\Models\Service;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        sleep(1);
        $username = Auth::user()->username;
        $my_properties = Property::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(5);

        return Inertia::render('Admin/Index', compact('my_properties', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        sleep(1);
        $services = Service::all();
        return Inertia::render('Admin/Create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $request->validate(
            [
                'name' => 'required|min:10|max:100',
                'size' => 'numeric|max:1000',
                'description' => 'required|min:10|max:1000',
                'cover_image' => 'image|required',
                'beds' => 'numeric|required',
                'rooms' => 'numeric|required',
                'price' => 'numeric|required|min:1',
                'address' => 'required'
            ],
            [
                'name.required' => 'Il titolo dell\'annuncio é obbligatorio.',
                'name.min' => 'Minimo :min caratteri.',
                'name.max' => 'Titolo troppo lungo. Max :max caratteri.',
                'size.numeric' => 'Valore non valido',
                'size.max' => 'Valore inserito troppo grande.',
                'description.required' => 'La descrizione dell\'annuncio é obbligatoria.',
                'description.min' => 'Minimo :min caratteri.',
                'description.max' => 'Testo troppo lungo. Max :max caratteri.',
                'cover_image.image' => 'File immagine non supportato.',
                'cover_image.required' => 'Immagine di copertina obbligatoria.',
                'rooms.numeric' => 'Valore non valido.',
                'rooms.required' => 'Valore obbligatorio.',
                'beds.numeric' => 'Valore non valido',
                'bathrooms.numeric' => 'Valore non valido',
                'price.numeric' => 'Valore non valido',
                'price.required' => 'Il prezzo dell\'annuncio é obbligatorio.',
                'address.required' => 'Indirizzo obbligatorio.',
            ]
        );

        $form_data = $request->all();

        $property = Property::create([
            'name' => $form_data['name'],
            'slug' => Property::slugGenerator($form_data['name']),
            'description' => $form_data['description'],
            'cover_image' => Storage::put('uploads', $form_data['cover_image']),
            'beds' => $form_data['beds'],
            'rooms' => $form_data['rooms'],
            'bathrooms' => $form_data['bathrooms'],
            'size' => $form_data['size'],
            'price' => $form_data['price'],
            'address' => $form_data['address'],
            'user_id' => Auth::id(),
            'is_visible' => $form_data['is_visible'],
            'is_sponsored' => false,
            'latitude' => $form_data['latitude'],
            'longitude' => $form_data['longitude']
        ]);
        //dd($form_data['gallery']);

        if (array_key_exists('gallery', $form_data)) {
            foreach ($form_data['gallery'] as $file) {
                Media::create([
                    'file_name' => Storage::put('uploads', $file),
                    'property_id' => $property->id
                ]);
            }
        }

        if (array_key_exists('services', $form_data)) {
            $property->services()->attach($form_data['services']);
        }

        return to_route('properties.index')->with('infoMessage', "Proprietà #ID$property->id aggiunta al tuo account.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, MonthlyVisits $chart_visit, MonthlyMessages $chart_message)
    {
        sleep(1);
        $test = 'Ciao';

        if ($property->user_id <> Auth::id()) return abort(404);
        $services = $property->services()->get();
        $media_property = Media::where('property_id', $property->id)->get();

        $chart_visit = $this->generateStatsVisit($property->id, $chart_visit);
        $chart_message = $this->generateStatsMessages($property->id, $chart_message);
        //dd($counts);
        // dd($media_property);
        return Inertia::render('Admin/Show', compact('property', 'services', 'media_property', 'chart_visit', 'chart_message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        sleep(1);
        //dd($property);
        if ($property->user_id <> Auth::id()) return abort(404);
        $propertyServices = $property->services()->get();
        $services = Service::all();
        $media_property = Media::where('property_id', $property->id)->get();

        return Inertia::render('Admin/Edit', compact('property', 'media_property', 'propertyServices', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //dd($request->all());

        $request->validate(
            [
                'name' => 'required|min:10|max:100',
                'size' => 'numeric|max:1000',
                'description' => 'required|min:10|max:1000',
                'beds' => 'numeric|required',
                'rooms' => 'numeric|required',
                'price' => 'numeric|required|min:1',
                'address' => 'required'
            ],
            [
                'name.required' => 'Il titolo dell\'annuncio é obbligatorio.',
                'name.min' => 'Minimo :min caratteri.',
                'name.max' => 'Titolo troppo lungo. Max :max caratteri.',
                'size.numeric' => 'Valore non valido',
                'size.max' => 'Valore inserito troppo grande.',
                'description.required' => 'La descrizione dell\'annuncio é obbligatoria.',
                'description.min' => 'Minimo :min caratteri.',
                'description.max' => 'Testo troppo lungo. Max :max caratteri.',
                'rooms.numeric' => 'Valore non valido.',
                'rooms.required' => 'Valore obbligatorio.',
                'beds.numeric' => 'Valore non valido',
                'bathrooms.numeric' => 'Valore non valido',
                'price.numeric' => 'Valore non valido',
                'price.required' => 'Il prezzo dell\'annuncio é obbligatorio.',
                'address.required' => 'Indirizzo obbligatorio.',
            ]
        );

        $property_edit = $request->all();
        $media_property = Media::where('property_id', $property->id)->get();

        if (!is_null($property_edit['cover_image'])) {
            Storage::disk('public')->delete($property->cover_image);
            $property_edit['cover_image'] = Storage::put('uploads', $property_edit['cover_image']);
        } else {
            $property_edit['cover_image'] = $property->cover_image;
        }

        if (count($property_edit['editGallery'])) {
            foreach ($media_property as $media) {
                Storage::disk('public')->delete($media->file_name);
                $media->delete();
            }

            //dd($property_edit['editGallery']);
            foreach ($property_edit['editGallery'] as $file) {
                Media::create([
                    'file_name' => Storage::put('uploads', $file),
                    'property_id' => $property->id
                ]);
            }
        }

        if (array_key_exists('services', $property_edit)) {
            $property->services()->sync($property_edit['services']);
        } else {
            $property->services()->detach();
        }

        $property->update($property_edit);

        return to_route('properties.index')->with('infoMessage', "Proprietà #ID$property->id modificata correttamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $media_property = Media::where('property_id', $property->id)->get();

        //dd($media_property);

        foreach ($media_property as $media) {
            Storage::disk('public')->delete($media->file_name);
            $media->delete();
        }

        //dd($property->cover_image);
        Storage::disk('public')->delete($property->cover_image);

        $old_id = $property->id;

        $property->delete();

        return to_route('properties.index')->with('infoMessage', "Proprietà #ID$old_id rimossa dal tuo account");;
    }

    public function generateStatsVisit($id, MonthlyVisits $chart_visit)
    {
        $timestamps = Stat::where('property_id', $id)->pluck('created_at')->toArray();
        $counts = array();
        for ($i = 1; $i <= 12; $i++) {
            $counts[sprintf('%02d', $i)] = 0;
        }
        foreach ($timestamps as $timestamp) {
            $month = date('m', strtotime($timestamp));
            if (isset($counts[$month])) {
                $counts[$month]++;
            }
        }
        ksort($counts);

        return $chart_visit->build($counts);
    }

    public function generateStatsMessages($id, MonthlyMessages $chart_message)
    {
        $timestamps = Message::where('property_id', $id)->pluck('created_at')->toArray();
        $counts = array();
        for ($i = 1; $i <= 12; $i++) {
            $counts[sprintf('%02d', $i)] = 0;
        }
        foreach ($timestamps as $timestamp) {
            $month = date('m', strtotime($timestamp));
            if (isset($counts[$month])) {
                $counts[$month]++;
            }
        }
        ksort($counts);

        return $chart_message->build($counts);
    }
}
