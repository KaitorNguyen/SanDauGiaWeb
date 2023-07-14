<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $categories = Category::all();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        // $products = Product::all();
        $products = Product::paginate(3);
        return view('home', compact('categories','products'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
