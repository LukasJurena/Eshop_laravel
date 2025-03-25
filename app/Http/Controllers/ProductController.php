<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        // Načte všechny produkty z databáze
        $products = Product::all();

        // Předá produkty do view
        
        $query = Product::query();

        // Pokud je zadán vyhledávací výraz, filtruj produkty
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Získej produkty podle filtru
        $products = $query->get();

        // Vrátit pohled se seznamem produktů
        return view('products.index', compact('products'));
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
    }

    /**
     * Display the specified resource.
     */
      public function show($id)
            {
                   $product = Product::findOrFail($id);

                // Get related products (you can adjust the logic to suit your needs)
                    $relatedProducts = Product::where('id', '!=', $product->id)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();


                // Předá produkt do view
                return view('products.show', compact('product','relatedProducts'));
            }
    public function search(Request $request)
        {
            $query = $request->input('query');
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();
            return view('products.index', compact('products'));
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}