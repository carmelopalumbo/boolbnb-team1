<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Property;
use App\Models\Service;
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

        //dd($request);
        $request->validate(
            [
                'name' => 'required|min:10|max:100',
                'size' => 'numeric|min:1|max:1000',
                'description' => 'required|min:10|max:1000',
                'cover_image' => 'required|image',
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
                'cover_image.image' => 'File immagine non supportato.',
                'rooms.numeric' => 'Valore non valido',
                'beds.numeric' => 'Valore non valido',
                'bathrooms.numeric' => 'Valore non valido',
                'price.numeric' => 'Valore non valido',
                'price.required' => 'Il prezzo dell\'annuncio é obbligatorio.',
                'address.required' => 'Indirizzo obbligatorio.',
            ]
        );

        //dd($request->all());
        //dd($validate);

        $form_data = $request->all();

        // dd($form_data['image']);
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
            'is_visible' => true,
            'is_sponsored' => false,
            'latitude' => $form_data['latitude'],
            'longitude' => $form_data['longitude']
        ]);
        //dd($form_data['gallery']);

        if (count($form_data['gallery'])) {
            foreach ($form_data['gallery'] as $file) {
                Media::create([
                    'file_name' => Storage::put('uploads', $file),
                    'property_id' => $property->id
                ]);
            }
        }

        if (count($form_data['services'])) {
            $property->services()->attach($form_data['services']);
        }

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
        if ($property->user_id <> Auth::id()) return abort(404);
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
        //dd($property);
        if ($property->user_id <> Auth::id()) return abort(404);
        $media_property = Media::where('property_id', $property->id)->get();

        return Inertia::render('Admin/Edit', compact('property', 'media_property'));
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
        $media_property = Media::where('property_id', $property->id)->get();

        if ($property->cover_image <> $property_edit['cover_image']) {
            Storage::put('uploads', $property_edit['cover_image']);
            Storage::disk('public')->delete($property->cover_image);
            $property->cover_image = $property_edit['cover_image'];
        }


        //dd($property_edit['editGallery']);

        if (!count($property_edit['editGallery'])) {
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
        $media_property = Media::where('property_id', $property->id)->get();

        //dd($media_property);

        foreach ($media_property as $media) {
            Storage::disk('public')->delete($media->file_name);
            $media->delete();
        }

        //dd($property->cover_image);
        Storage::disk('public')->delete($property->cover_image);

        $property->delete();

        return to_route('properties.index');
    }
}
