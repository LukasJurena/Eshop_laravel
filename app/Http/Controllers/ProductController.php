<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        
        $products = Product::query();

        // Apply filters if present
        if ($request->has('price_from')) {
            $products->where('price', '>=', $request->input('price_from'));
        }
        if ($request->has('price_to')) {
            $products->where('price', '<=', $request->input('price_to'));
        }
        if ($request->has('category')) {
            $products->whereIn('category', $request->input('category'));
        }

        // Apply sorting if present
        if ($request->has('sort_by')) {
            $sort = $request->input('sort_by');
            if ($sort == 'price_asc') {
                $products->orderBy('price', 'asc');
            } elseif ($sort == 'price_desc') {
                $products->orderBy('price', 'desc');
            } elseif ($sort == 'name_asc') {
                $products->orderBy('name', 'asc');
            } elseif ($sort == 'name_desc') {
                $products->orderBy('name', 'desc');
            } elseif ($sort == 'rating_desc') {
                $products->orderBy('rating', 'desc');
            }
        }

        // Paginate the results
        $products = $products->paginate(12); // Change 12 to the number of items per page you want

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
