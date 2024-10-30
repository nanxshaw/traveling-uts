<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationOrder;
use Illuminate\Http\Request;

class AccommodationOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = AccommodationOrder::with('accommodation')->get();
        return view('accommodation_orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accommodations = Accommodation::all();
        return view('accommodation_orders.create', compact('accommodations'));
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
            'accommodation_id' => 'required|exists:accommodations,id',
            'customer_name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        AccommodationOrder::create($request->all()); 
        return redirect()->route('accommodation-orders.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AccommodationOrder $accommodationOrder)
    {
        $accommodations = Accommodation::all();
        return view('accommodation_orders.edit', compact('accommodationOrder', 'accommodations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccommodationOrder $accommodationOrder)
    {
        $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id',
            'customer_name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $accommodationOrder->update($request->all());
        return redirect()->route('accommodation-orders.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccommodationOrder $accommodationOrder)
    {
        $accommodationOrder->delete();
        return redirect()->route('accommodation-orders.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
