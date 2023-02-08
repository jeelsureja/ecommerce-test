<?php

namespace App\Http\Controllers\Cart;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartRequest;
use App\Models\OrderDetails;
use App\Models\Product;

class CartController extends Controller
{
    public function cart()
    {
        try {
            return view("cart.cart");
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'somthing went wrong']);
        }
    }

    public function addToCart($id)
    {
        try {
            $product = Product::find($id);

            $cart = session()->get('cart', []);

            if (!empty($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "product_id" => $product->id,
                    "product_name" => $product->product_name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image" => $product->image,
                ];
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'somthing went wrong']);
        }
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash("success", "Cart updated successfully");
        }
    }

    public function remove(Request $request)
    {
        // dd($request->all());
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash("success", "Cart product removed successfully");
        }
    }

    public function checkout()
    {
        $total = 0;

        if (session('cart')) {
            foreach (session('cart') as $id => $details) {
                $total = $total + ($details['price'] * $details['quantity']);
            }
        }
        $product = Product::find($details['product_id']);
        $quantity = $details['quantity'];

        return view('cart.checkout', compact('total', 'product', 'quantity'));
    }

    public function placeOrder(CartRequest $request)
    {
        try {
            // dd(session('cart'));
            $user = auth()->user();

            $total = 0;
            if (session('cart')) {
                foreach (session('cart') as $id => $details) {
                    $total = $total + ($details['price'] * $details['quantity']);
                }
            }
            // dd($details);
            $order = OrderDetails::create([
                'user_id' => $user->id,
                'quantity' => $details['quantity'],
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'biling_address' => $request->biling_address,
            ]);

            foreach (session('cart') as $item) {
                // dd($item);
                $product = Product::find($item['product_id']);
                if($product->stock = 0 && $product->stock >= $item['quantity']) {
                    $product->decrement('stock', $item['quantity']);
                } else {
                    return redirect()->route('cart')->with(['error' => 'Stock shortage']);
                }
                $quantity = $item['quantity'];
            }
            session()->forget('cart');
            return redirect()->route('product-list')->with('success', 'Order place successfully');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
