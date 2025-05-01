<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver clientes');

        // 1) Construcción de consulta con eager loading
        $query = Customer::with('province');

        // 2) Filtro por nombre
        if ($request->filled('buscar')) {
            $q = $request->buscar;
            $query->where('name', 'like', "%{$q}%");
        }

        // 3) Filtro por provincia
        if ($request->filled('province_id')) {
            $query->where('province_id', $request->province_id);
        }

        // 4) Orden, paginación y conservación de query string
        $customers = $query
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        // 5) Provincias para el select de filtro / modal
        $provinces = Province::all();

        return view('modulos.clientes.index', compact('customers', 'provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('crear clientes');

        $provinces = Province::all();
        return view('modulos.clientes.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('crear clientes');

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'nif'         => 'nullable|string|max:50',
            'address'     => 'required|string|max:255',
            'phone'       => 'required|string|max:50',
            'email'       => 'required|email|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        Customer::create($data);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('ver clientes');

        $customer = Customer::with('province')->findOrFail($id);

        return view('modulos.clientes.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('editar clientes');

        $customer  = Customer::findOrFail($id);
        $provinces = Province::all();

        return view('modulos.clientes.edit', compact('customer', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('editar clientes');

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'nif'         => 'nullable|string|max:50',
            'address'     => 'required|string|max:255',
            'phone'       => 'required|string|max:50',
            'email'       => 'required|email|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($data);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('eliminar clientes');

        $customer = Customer::find($id);

        if (! $customer) {
            return redirect()->route('clientes.index')
                             ->with('error', 'Cliente no encontrado.');
        }

        $customer->delete();

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente eliminado correctamente.');
    }
}

