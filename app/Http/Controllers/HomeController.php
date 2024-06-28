<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = config('products');

        return view('home', compact('products'));
    }

    public function show($id)
    {
        $products = config('products');

        $product = collect($products)->firstWhere('id', $id);

        return view('product', compact('product'));
    }
}
