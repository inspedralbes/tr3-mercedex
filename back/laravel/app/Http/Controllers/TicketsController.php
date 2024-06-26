<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Ticket_Product;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // mostrar todos los tickets del usuario autenticado
        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        
        $ticketsAllInfo = [];
        foreach ($tickets as $ticket) {
            $tickets_products = Ticket_Product::where('ticket_id', $ticket->id)->get();
            $products = [];
            foreach ($tickets_products as $ticket_product) {
                $product = Product::find($ticket_product->product_id);
                
                $product_info = (object) [
                    'quantity' => $ticket_product->quantity,
                    'image' => $product->image,
                    'name' => $product->name,
                    'price' => $product->price * $ticket_product->quantity,
                ];
                
                $products[] = $product_info;
            }
            $ticket->products = $products;
            $ticketsAllInfo[] = $ticket;
        }
        
        

        return response()->json($ticketsAllInfo);
        
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
            'name' => 'nullable|string',
            'lastname' => 'nullable|string',
            'postal_code'=> 'required',
            'city'=> 'required|string',
            'country'=> 'required|string',
            'status' => 'string',
            'address' => 'required|string',
            'phone' => 'required|string|max:9',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',


        ]);

        // Crear un nuevo ticket en la base de datos
        $ticket = new Ticket();
        $ticket->status = 'pendiente';
        $ticket->address = $request->address;
        $ticket->phone = $request->phone;
        $ticket->total = $total;
        $ticket->postal_code = $request->postal_code;
        $ticket->city = $request->city;
        $ticket->country = $request->country;
        $ticket->user_id = auth()->user()->id;
        $ticket->name = auth()->user()->name;
        $ticket->lastname = auth()->user()->lastname;
        $ticket->email = auth()->user()->email;
        $ticket->save();

        //devolver el id del ticket creado
        return response()->json(['id' => $ticket->id]);
        
    }

    //cancelar ticket
    public function cancel(Request $request, string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket no encontrado'], 404);
        }

        if ($ticket->status === 'cancelado') {
            return response()->json(['message' => 'El ticket ya ha sido cancelado'], 409);
        }

        if ($ticket->status === 'enviado') {
            return response()->json(['message' => 'El ticket ya ha sido enviado'], 409);
        }

        $ticket->status = 'cancelado';
        $ticket->save();

        return response()->json(['message' => 'Ticket cancelado con éxito']);
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
