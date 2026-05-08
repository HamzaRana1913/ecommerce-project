<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category')) {
            $query->whereIn('category', (array) $request->category);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        switch ($request->sort) {
            case 'price_asc':  $query->orderBy('price'); break;
            case 'price_desc': $query->orderByDesc('price'); break;
            case 'name':       $query->orderBy('name'); break;
            default:           $query->latest(); break;
        }

        $products = $query->paginate(12)->withQueryString();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product      = Product::findOrFail($id);
        $related      = Product::where('category', $product->category)
                               ->where('id', '!=', $product->id)
                               ->take(4)->get();
        return view('products.show', compact('product', 'related'));
    }
}
