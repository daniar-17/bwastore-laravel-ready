<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $categories = Category::all();
        $products = Product::with('galleries')->paginate(32);
        return view('pages/category', compact('categories','products'));
    }

    public function detail(Request $request, $slug)
    {
        Paginator::useBootstrap();
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with('galleries')->where('categories_id', $category->id)->paginate(32);
        return view('pages/category', compact('categories','products'));
    }
}
