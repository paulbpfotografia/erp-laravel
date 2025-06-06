<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewProductMail;
use App\Models\Customer;


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
    public function index(Request $request)
    {
        // 1) Autorización:
        $this->authorize('ver productos');

        // 2) Construcción de la consulta base con eager loading de la categoría:
        $query = Product::with('category');

        // 3) Filtro por búsqueda de nombre
        if ($request->filled('buscar')) {
            $query->where('name', 'like', "%{$request->buscar}%");
        }
        // 4) Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('category_id', $request->categoria_id);
        }

        // 3) Orden, paginación y conservación de la query string:
        $products = $query
            ->orderByDesc('id')            // orden descendente por ID (o por created_at)
            ->paginate(15)                 // 50 ítems por página
            ->withQueryString();           // conserva GET parameters en los enlaces

        // 4) Cargamos las categorías para el modal de creación:
        $categories = Category::all();

        // 5) Devolvemos la vista con la colección paginada:
        return view('modulos.productos.productos', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear productos');

        // Trae las categorías para el select
        $categories = Category::all();

        // Devuelve la vista: resources/views/productos/create.blade.php
        return view('modulos.productos.create', compact('categories'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $categoriaNombre = strtolower(Category::find($request->category_id)->name);
            $folder = 'images/products/' . $categoriaNombre;

            // Asegurar que la carpeta exista
            if (!file_exists(public_path($folder))) {
                mkdir(public_path($folder), 0777, true);
            }

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($folder), $fileName);

            $imagePath = $folder . '/' . $fileName;
        } else {
            $imagePath = null;
        }


        // Crear el producto
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        // Crear detalle del producto
        $product->details()->create([
            'description' => $request->input('detail_description')
        ]);

        // Crear especificaciones del producto
        $product->specs()->create([
            'weight' => $request->input('weight'),
            'dimensions' => $request->input('dimensions'),
            'color' => $request->input('color'),
            'material' => $request->input('material'),
        ]);



        // Buscar un cliente con correo válido (por ejemplo, el último insertado con email real)
        $customer = Customer::whereNotNull('email')
            ->where('email', 'like', '%@gmail.%')
            ->latest()
            ->first();

        if ($customer) {
            Mail::to($customer->email)->send(new NewProductMail($product));
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente y correo enviado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el producto por ID
        //$product = Product::findOrFail($id);
        $product = Product::with([
            'details',       // para cargar la info de product_details
            'specs',         // para cargar la info de product_specs
            'category'       // traer también la categoría
        ])->findOrFail($id);

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        // Buscar el producto por ID
        $product = Product::findOrFail($id);
        $imagePath = $product->image; //Mantiene la imagen si no se remplaza

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Borrar imagen anterior si existe
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $categoriaNombre = strtolower(Category::find($request->category_id)->name);
            $folder = 'images/products/' . $categoriaNombre;

            if (!file_exists(public_path($folder))) {
                mkdir(public_path($folder), 0777, true);
            }

            // Crear un nombre único por producto
            $extension = $file->getClientOriginalExtension();
            $fileName = 'product_' . $product->id . '.' . $extension;
            $file->move(public_path($folder), $fileName);

            // Ruta final que se guarda en la BBDD
            $imagePath = $folder . '/' . $fileName;
        }


        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
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
