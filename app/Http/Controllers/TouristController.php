<?php

namespace App\Http\Controllers;

use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TouristController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourists = Tourist::all();
        return view('tourists.index', compact('tourists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tourists.create');
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
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validasi gambar
        ]);

        // Menyimpan gambar ke storage
        $imagePath = $request->file('image')->store('tourist', 'public');

        Tourist::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $imagePath, // Menyimpan path gambar
        ]);

        return redirect()->route('tourists.index')->with('success', 'Wisata berhasil ditambahkan.');
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
    public function edit(Tourist $tourist)
    {
        return view('tourists.edit', compact('tourist'));
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
         $tourist = Tourist::findOrFail($id);
 
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'required|string',
             'location' => 'required|string|max:255',
             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
         ]);
 
         if ($request->hasFile('image')) {
             if ($tourist->image) {
                 Storage::disk('public')->delete($tourist->image);
             }
             $imagePath = $request->file('image')->store('tourist', 'public');
             $tourist->image = $imagePath; 
         }
 
         $tourist->name = $request->name;
         $tourist->description = $request->description;
         $tourist->location = $request->location;
         $tourist->save();
 
         return redirect()->route('tourists.index')->with('success', 'Wisata berhasil diperbarui.');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tourist $tourist)
    {
        $tourist->delete();
        return redirect()->route('tourists.index')->with('success', 'Wisata berhasil dihapus.');
    }
}
