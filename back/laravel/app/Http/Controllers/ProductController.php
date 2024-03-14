<?php

namespace App\Http\Controllers;
use App\Models\Product;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Devolver todos los productos de la base de datos

        $products = Product::all();

        return response()->json([
            'products' => $products
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        foreach ($request->items as $item) {
            $product = Product::find($item['id']);
    
            if (!$product) {
                return response()->json([
                    'message' => 'Producto no encontrado'
                ], 400);
            }

            if ($item['quantity'] <= 0) {
                return response()->json([
                    'message' => 'La cantidad debe ser mayor que 0'
                ], 400);
            }
    
            if ($product->stock < $item['quantity']) {
                return response()->json([
                    'message' => 'No hay suficiente stock para ' . $product->name
                ], 400);
            }
        }
    

        foreach ($request->items as $item) {
            $product = Product::find($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }
    
        return response()->json([
            'message' => 'Productos vendidos con éxito'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
