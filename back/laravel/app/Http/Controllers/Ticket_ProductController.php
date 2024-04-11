<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Product;
use App\Models\Ticket_Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Mail;
use App\Mail\Subscribe;



class Ticket_ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($ticketId)
    {
        // Obtener el ticket
        $ticket = Ticket::findOrFail($ticketId);

        // Obtener todos los productos asociados al ticket
        $productos = $ticket->products;

        // select a la tabla product con los id de los productos asociados al ticket
        $productos = Product::select('products.id', 'products.name', 'products.price', 'products.stock')
            ->join('ticket_product', 'products.id', '=', 'ticket_product.product_id')
            ->where('ticket_product.ticket_id', $ticketId)
            ->get();


        // Retorna los productos asociados al ticket
        return response()->json(['productos' => $productos], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $ticketId)
    {
        // Buscar el ticket
        $ticket = Ticket::findOrFail($ticketId);



        // Validar los datos de entrada
        $validatedData = $request->validate([
            'products' => 'required|array', // Cambio de 'products.*' a 'products'
            'products.*.productId' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Recorrer los productos y asociarlos al ticket
        foreach ($request->products as $productData) {
            $productId = $productData['productId'];
            $quantity = $productData['quantity'];

            $product = Product::findOrFail($productId);

            if ($product->stock < $quantity) {
                return response()->json(['message' => 'No hay stock en el producto'], 400);
            }

            $ticket->products()->attach($productId, ['quantity' => $quantity]);
            $product->stock -= $quantity;
            $product->save();
        }


        $ticket = Ticket::findOrFail($ticketId);
        $productos = Product::select('name', 'image', 'price', 'ticket_product.quantity')
            ->join('ticket_product', 'products.id', '=', 'ticket_product.product_id')
            ->where('ticket_product.ticket_id', $ticketId)
            ->get();
        
        $email = auth()->user()->email;
        Mail::to($email)->send(new Subscribe($ticket, $productos));


        return response()->json([
            'message' => 'Productos asociados al ticket con éxito'
        ], 200);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
