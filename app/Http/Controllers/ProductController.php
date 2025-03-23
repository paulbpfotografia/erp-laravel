<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    /**
     * public function producto()
     *   {
     *   return view(view: 'modulos.productos.producto'); // PARA PROBAR MENÚ
     *}
     */



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->get(); // Obtener productos con sus categorías
        $categories = Category::all(); // Obtener todas las categorías para el modal
        return view('modulos.productos.productos', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Subir la imagen si se proporciona
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }

        // Crear el producto
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el producto por ID
        $product = Product::findOrFail($id);
        
        return view('modulos.productos.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el producto por ID
        $product = Product::findOrFail($id);
        // Obtener todas las categorías
        $categories = Category::all();
        // Pasar el producto y las categorías a la vista
        return view('modulos.productos.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Buscar el producto por ID
        $product = Product::findOrFail($id);
        
        // Si se ha subido una nueva imagen
    if ($request->hasFile('image')) {
        // Eliminar la imagen anterior (si existe)
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Subir la nueva imagen
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('eliminar productos');
        
        $product = Product::find($id); // Buscar producto manualmente

        if (!$product) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }

        $product->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }
}
