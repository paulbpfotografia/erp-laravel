<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Product;
use App\Models\Category;
use App\Models\MoveStock;
use App\Models\Stock;




use Illuminate\Http\Request;

class WarehouseLogisticController extends Controller
{
    public function inventory(Request $request)
    {
        $query = Product::with(['stock', 'category'])->orderBy('name');

        // Filtro por ID o nombre
        if ($request->filled('product_id')) {
            $query->where('id', $request->product_id)
                  ->orWhere('name', 'like', '%' . $request->product_id . '%');
        }

        // Filtro por categoría
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('modulos.logistica.almacen.almacen-inventario', compact('products', 'categories'));
    }








    public function indexEntradas(Request $request)
    {
        $query = MoveStock::with('product')
            ->where('move_type', 'entrada')
            ->orderByDesc('move_date');

        if ($request->filled('product_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_name . '%');
            });
        }

        if ($request->filled('reason')) {
            $query->where('reason', 'like', '%' . $request->reason . '%');
        }

        $entradas = $query->paginate(10)->withQueryString();

        return view('modulos.logistica.almacen.almacen-entradas', compact('entradas'));
    }




    public function createEntry()
{
    $products = Product::orderBy('name')->get();
    return view('modulos.logistica.almacen.almacen-entradas-crear', compact('products'));
}



public function storeEntry(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'reason' => 'required|string|max:255',
    ]);

    $product = Product::findOrFail($request->product_id);

    // Actualizar stock
    $stock = $product->stock ?? new Stock(['product_id' => $product->id]);
    $stock->available_quantity = ($stock->available_quantity ?? 0) + $request->quantity;
    $stock->save();

    // Registrar movimiento
    MoveStock::create([
        'move_type' => 'entrada',
        'quantity' => $request->quantity,
        'reason' => $request->reason,
        'move_date' => Carbon::now(),
        'product_id' => $product->id,
    ]);

    return redirect()->route('logistica.almacen.entradas')
                     ->with('success', 'Entrada registrada correctamente.');
}




}
