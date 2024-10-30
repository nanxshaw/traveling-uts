<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accommodations = Accommodation::all();
        return view('accommodations.index', compact('accommodations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accommodations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'price' => 'required|numeric',
             'location' => 'required|string|max:255',
             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
         ]);
 
         $accommodation = new Accommodation();
         $accommodation->name = $request->name;
         $accommodation->price = $request->price;
         $accommodation->location = $request->location;
 
         if ($request->hasFile('image')) {
             $imagePath = $request->file('image')->store('accommodation', 'public');
             $accommodation->image = $imagePath;
         }
 
         $accommodation->save();
         return redirect()->route('accommodations.index')->with('success', 'Akomodasi berhasil ditambahkan.');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        return view('accommodations.edit', compact('accommodation'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accommodation = Accommodation::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $accommodation->name = $request->name;
        $accommodation->price = $request->price;
        $accommodation->location = $request->location;

        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage
            if ($accommodation->image) {
                Storage::disk('public')->delete($accommodation->image);
            }
            $imagePath = $request->file('image')->store('accommodation', 'public');
            $accommodation->image = $imagePath;
        }

        $accommodation->save();
        return redirect()->route('accommodations.index')->with('success', 'Akomodasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        if ($accommodation->image) {
            Storage::disk('public')->delete($accommodation->image);
        }
        $accommodation->delete();
        return redirect()->route('accommodations.index')->with('success', 'Akomodasi berhasil dihapus.');
    }
}
