<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function Home(Request $request)
    {
        try {
            return view('home');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'somthing went wrong']);
        }
    }
}
