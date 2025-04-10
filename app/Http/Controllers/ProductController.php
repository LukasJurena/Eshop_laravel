<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Pokud je zadán vyhledávací výraz, filtruj produkty
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Filtr podle ceny
        if ($request->has('price_from') && $request->price_from != '') {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->has('price_to') && $request->price_to != '') {
            $query->where('price', '<=', $request->price_to);
        }

        // Řazení
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Get related products (you can adjust the logic to suit your needs)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(10)
            ->get();

        // Předá produkt do view
        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        // Debugging - vypíše dotaz z formuláře
        dd($request->input('query')); 

        $query = $request->input('query');
        
        // Pokud není dotaz, přesměrovat zpět
        if (!$query) {
            return redirect()->route('products.index');
        }

        // Vyhledávání podle názvu a popisu
        $products = Product::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        // Pokud nejsou žádné produkty
        if ($products->isEmpty()) {
            return back()->with('message', 'Žádné produkty nenalezeny.');
        }

        // Předat produkty do pohledu
        return view('products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
