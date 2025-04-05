<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Zobrazení stránky checkout
    public function index()
    {
        return view('checkout.index');
    }

    // Zpracování objednávky
    public function process(Request $request)
    {
        // Validace požadavku
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'payment_method' => 'required|in:paypal,gopay,visa',
        ]);

        // Zpracování platby podle platební metody
        switch ($request->payment_method) {
            case 'paypal':
                return $this->processPaypalPayment($request);
            case 'gopay':
                return $this->processGoPayPayment($request);
            case 'visa':
                return $this->processVisaPayment($request);
            default:
                return redirect()->back()->with('error', 'Neznámá platební metoda.');
        }
    }

    // Zpracování platby přes PayPal
    private function processPaypalPayment($request)
    {
        // Zde by měl být kód pro PayPal integraci
        return redirect()->route('payment.success')->with('message', 'Platba přes PayPal byla úspěšná.');
    }

    // Zpracování platby přes GoPay
    private function processGoPayPayment($request)
    {
        // Zde by měl být kód pro GoPay integraci
        return redirect()->route('payment.success')->with('message', 'Platba přes GoPay byla úspěšná.');
    }

    // Zpracování platby přes Visa
    private function processVisaPayment($request)
    {
        // Zde by měl být kód pro Visa platební bránu
        return redirect()->route('payment.success')->with('message', 'Platba přes Visa byla úspěšná.');
    }

    // Zpracování checkout a vytvoření objednávky
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Košík je prázdný.');
        }

        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Vytvoření objednávky
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'total_price' => $totalPrice,
        ]);

        session()->forget('cart'); // Vyprázdnění košíku

        return redirect()->route('checkout.success')->with('success', 'Objednávka byla úspěšně vytvořena.');
    }

    // Zobrazení stránky úspěchu
    public function success()
    {
        return view('checkout.success');
    }
    public function paymentSuccess()
    {
        return view('payment.success');
    }
}
