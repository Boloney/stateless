<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $path = 'home.';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        return view($this->path . 'index', compact('products', 'categories'));
    }

    public function home()
    {
        return view($this->path . 'home');
    }
}
