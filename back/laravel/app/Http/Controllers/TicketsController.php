<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Product;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mostrar todos los tickets de la base de datos

        $tickets = Ticket::all();
        return response()->json([
            'tickets' => $tickets
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $total = 0;
        foreach ($request->items as $item) {
            $product = Product::find($item['id']);
            
            if (!$product) {
                return response()->json(['message' => 'Producto no encontrado'], 404);
            }
            
            if ($item['quantity'] <= 0) {
                return response()->json(['message' => 'La cantidad debe ser mayor que 0'], 422);
            }
            
            if ($product->stock < $item['quantity']) {
                return response()->json(['message' => 'No hay suficiente stock para ' . $product->name], 409);
            }
            
            $product->stock -= $item['quantity'];
            $total += $product->price * $item['quantity'];
            $product->save();
        }
        $validatedData = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'status' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Crear un nuevo ticket en la base de datos
        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->lastname = $request->lastname;
        $ticket->status = 'pendiente';
        $ticket->address = $request->address;
        $ticket->phone = $request->phone;
        $ticket->email = $request->email;
        $ticket->total = $total;
        $ticket->save();

        return response()->json([
            'message' => 'Ticket creado con éxito y productos vendidos con éxito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
