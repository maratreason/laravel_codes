<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request) {
        // Log::channel('single')->debug($request->ip());
        Debugbar::info($request);

        // $productsQuery = Product::query();
        $productsQuery = Product::with('category'); // этот запрос работает намного быстрее чем query().

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }

        foreach(['hit', 'new', 'recommend'] as $field) {
            if ($request->has($field)) {
                $productsQuery->$field();
                // $productsQuery->where($field, 1);
            }
        }
        $products = $productsQuery->paginate(6)->withPath("?".$request->getQueryString());
        return view('index', compact('products'));
    }

    public function categories() {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function category($code) {
        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }

    public function product($category, $product = null) {
        $product = Product::where('code', $product)->first();
        return view('product', compact('product'));
    }
}
