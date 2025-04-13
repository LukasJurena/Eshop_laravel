<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        // Vyhledávání podle názvu nebo popisu
        if ($request->filled('query')) {
            $search = $request->input('query');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filtr ceny
        if ($request->has('price_from') && is_numeric($request->price_from)) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->has('price_to') && is_numeric($request->price_to)) {
            $query->where('price', '<=', $request->price_to);
        }

        // Filtr kategorií
        if ($request->has('category') && !empty($request->category)) {
            $categoryIds = (array) $request->category;
            $query->whereIn('category_id', $categoryIds);
        }

        // Třídění
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
                case 'rating_desc':
                    $query->withCount(['reviews as average_rating' => function($q) {
                        $q->select(\DB::raw('coalesce(avg(rating),0)'));
                    }])->orderBy('average_rating', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Stránkování
        $products = $query->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'categories'));
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

        // Get related products (same category, excluding current product)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // If not enough related products in the same category, add some random ones
        if ($relatedProducts->count() < 4) {
            $additionalProducts = Product::where('id', '!=', $product->id)
                ->where('category_id', '!=', $product->category_id)
                ->inRandomOrder()
                ->take(4 - $relatedProducts->count())
                ->get();
                
            $relatedProducts = $relatedProducts->concat($additionalProducts);
        }

        // Předá produkt do view
        return view('products.show', compact('product', 'relatedProducts'));
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
