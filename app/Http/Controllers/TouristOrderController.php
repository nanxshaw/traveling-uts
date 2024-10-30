<?php
namespace App\Http\Controllers;

use App\Models\Tourist;
use App\Models\TouristOrder;
use Illuminate\Http\Request;

class TouristOrderController extends Controller
{
    public function index()
    {
        $orders = TouristOrder::with('tourist')->get(); 
        return view('tourist_orders.index', compact('orders')); 
    }

    public function create()
    {
        $tourists = Tourist::all();
        return view('tourist_orders.create', compact('tourists')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'tourist_id' => 'required|exists:tourists,id',
            'customer_name' => 'required|string|max:255',
            'travel_date' => 'required|date',
        ]);

        TouristOrder::create($request->all());
        return redirect()->route('tourist-orders.index')->with('success', 'Pemesanan wisata berhasil dibuat!');
    }

    public function edit($id)
    {
        $order = TouristOrder::findOrFail($id);
        $tourists = Tourist::all(); 
        return view('tourist_orders.edit', compact('order', 'tourists')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tourist_id' => 'required|exists:tourists,id',
            'customer_name' => 'required|string|max:255',
            'travel_date' => 'required|date',
        ]);

        $order = TouristOrder::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('tourist-orders.index')->with('success', 'Pemesanan wisata berhasil diupdate!');
    }

    public function destroy($id)
    {
        $order = TouristOrder::findOrFail($id);
        $order->delete();
        return redirect()->route('tourist-orders.index')->with('success', 'Pemesanan wisata berhasil dihapus!');
    }
}
