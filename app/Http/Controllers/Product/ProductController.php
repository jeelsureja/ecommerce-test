<?php

namespace App\Http\Controllers\Product;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('productsBrand')->get();
            return view('products.list',compact('products'));
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
