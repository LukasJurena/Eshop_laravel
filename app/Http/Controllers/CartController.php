<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Method to add product to cart
    public function add(Request $request, $productId)
    {
        // Load product from database
        $product = Product::findOrFail($productId);

        // Get quantity from request (default to 1 if not set)
        $quantity = $request->input('quantity', 1);

        // Initialize cart if it doesn't exist
        if (!session()->has('cart')) {
            session(['cart' => []]);
        }

        // Get the current cart from the session
        $cart = session('cart');

        // Check if product already exists in the cart
        if (isset($cart[$productId])) {
            // Increment the quantity if product already exists
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Otherwise, add the new product to the cart
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => 'https://via.placeholder.com/300', // Add the image URL or dynamic path
            ];
        }

        // Save the updated cart back to the session
        session(['cart' => $cart]);

        // Check if 'stay' parameter is set in the request, if so, stay on the page
        if ($request->has('stay') && $request->stay == 'true') {
            return back()->with('cart_message', 'Produkt byl přidán do košíku!');
        }

        // Otherwise, redirect to the cart page
        return redirect()->route('cart.index')->with('cart_message', 'Produkt byl přidán do košíku!');
    }
    public function show($id)
    {
        $product = Product::with('reviews.user')->findOrFail($id);
        return view('products.show', compact('product'));
    }
    // Display the cart
    public function index()
    {
        // Pass cart data to the view
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Remove product from cart
    public function remove($productId)
    {
        // Get current cart
        $cart = session('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$productId])) {
            // Remove the product from the cart
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        // Redirect back to the cart
        return back();
    }
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);

            $itemTotal = $cart[$id]['price'] * $cart[$id]['quantity'];
            $cartTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

            return response()->json([
                'success' => true,
                'itemTotal' => $itemTotal,
                'cartTotal' => $cartTotal
            ]);
        }

        return response()->json(['success' => false], 400);
    }

}