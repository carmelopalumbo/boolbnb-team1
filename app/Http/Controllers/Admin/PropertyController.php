<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        $my_properties = Property::where('user_id', Auth::id())->get();
        return Inertia::render('Admin/Index', compact('my_properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate(
            [
                'name' => 'required|min:10|max:100',
                'size' => 'numeric|min:1|max:1000',
                'description' => 'required|min:10|max:1000',
                'cover_image' => 'required',
                'rooms' => 'numeric',
                'beds' => 'numeric',
                'bathrooms' => 'numeric',
                'price' => 'numeric|required|min:1',
                'address' => 'required'
            ],
            [
                'name.required' => 'Il titolo dell\'annuncio é obbligatorio.',
                'name.min' => 'Minimo :min caratteri.',
                'name.max' => 'Titolo troppo lungo. Max :max caratteri.',
                'size.numeric' => 'Valore non valido',
                'size.min' => 'Minimo :min caratteri.',
                'size.max' => 'Valore inserito troppo grande.',
                'description.required' => 'La descrizione dell\'annuncio é obbligatoria.',
                'description.min' => 'Minimo :min caratteri.',
                'description.max' => 'Testo troppo lungo. Max :max caratteri.',
                'cover_image.required' => 'Immagine di copertina obbligatoria.',
                'rooms.numeric' => 'Valore non valido',
                'beds.numeric' => 'Valore non valido',
                'bathrooms.numeric' => 'Valore non valido',
                'price.numeric' => 'Valore non valido',
                'price.required' => 'Il prezzo dell\'annuncio é obbligatorio.',
                'address.required' => 'Indirizzo obbligatorio.',
            ]
        );

        //dd($validate);

        Property::create([
            'name' => $request->name,
            'slug' => Property::slugGenerator($request->name),
            'description' => $request->description,
            'cover_image' => 'TEST',
            'beds' => $request->beds,
            'rooms' => $request->rooms,
            'bathrooms' => $request->bathrooms,
            'size' => $request->size,
            'price' => $request->price,
            'address' => $request->address,
            'user_id' => Auth::id(),
            'is_visible' => true,
            'is_sponsored' => false,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return to_route('properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return Inertia::render('Admin/Show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        // dd($property);
        return Inertia::render('Admin/Edit', compact('property'));
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
        $request->validate(
            [
                'name' => 'required|min:10|max:100',
                'size' => 'numeric|min:1|max:1000',
                'description' => 'required|min:10|max:1000',
                'cover_image' => 'required',
                'rooms' => 'numeric',
                'beds' => 'numeric',
                'bathrooms' => 'numeric',
                'price' => 'numeric|required|min:1',
                'address' => 'required'
            ],
            [
                'name.required' => 'Il titolo dell\'annuncio é obbligatorio.',
                'name.min' => 'Minimo :min caratteri.',
                'name.max' => 'Titolo troppo lungo. Max :max caratteri.',
                'size.numeric' => 'Valore non valido',
                'size.min' => 'Minimo :min caratteri.',
                'size.max' => 'Valore inserito troppo grande.',
                'description.required' => 'La descrizione dell\'annuncio é obbligatoria.',
                'description.min' => 'Minimo :min caratteri.',
                'description.max' => 'Testo troppo lungo. Max :max caratteri.',
                'cover_image.required' => 'Immagine di copertina obbligatoria.',
                'rooms.numeric' => 'Valore non valido',
                'beds.numeric' => 'Valore non valido',
                'bathrooms.numeric' => 'Valore non valido',
                'price.numeric' => 'Valore non valido',
                'price.required' => 'Il prezzo dell\'annuncio é obbligatorio.',
                'address.required' => 'Indirizzo obbligatorio.',
            ]
        );

        $property_edit = $request->all();
        $property->update($property_edit);

        return to_route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return to_route('properties.index');
    }
}
