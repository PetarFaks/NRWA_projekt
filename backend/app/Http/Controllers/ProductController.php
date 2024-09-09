<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    // Display a listing of the products.
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Show the form for creating a new product.
    public function create()
    {
        return view('products.create');
    }

    // Store a newly created product in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ProductName' => 'required|max:100',
            'ProductNumber' => 'required|max:15|unique:products',
            'Color' => 'nullable|max:15',
            'StandardCost' => 'required|numeric',
            'ListPrice' => 'required|numeric',
        ]);

        $product = Product::create($validatedData);

        if ($request->wantsJson()) {
            return response()->json($product, 201);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Display the specified product.
    public function show(Product $product)
    {
        if (request()->wantsJson()) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    // Show the form for editing the specified product.
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update the specified product in storage.
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'ProductName' => 'required|max:100',
            'ProductNumber' => 'required|max:15|unique:products,ProductNumber,' . $product->ProductID . ',ProductID',
            'Color' => 'nullable|max:15',
            'StandardCost' => 'required|numeric',
            'ListPrice' => 'required|numeric',
        ]);

        $product->update($validatedData);

        if ($request->wantsJson()) {
            return response()->json($product);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage.
    public function destroy(Product $product)
    {
        $product->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function admin_index()
    {
        
        return Product::all();
    }

    public function admin_store(Request $request)
    {
        

        $request->validate([
            'ProductName' => 'required|max:100',
            'ProductNumber' => 'required|max:15|unique:products',
            'Color' => 'nullable|max:15',
            'StandardCost' => 'required|numeric',
            'ListPrice' => 'required|numeric',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function admin_show(Product $product)
    {
        
        return $product;
    }

    public function admin_update(Request $request, Product $product)
    {
        

        $request->validate([
            'ProductName' => 'required|max:100',
            'ProductNumber' => 'required|max:15|unique:products,ProductNumber,' . $product->ProductID . ',ProductID',
            'Color' => 'nullable|max:15',
            'StandardCost' => 'required|numeric',
            'ListPrice' => 'required|numeric',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    public function admin_destroy(Product $product)
    {
        

        $product->delete();
        return response()->json(null, 204);
    }

    

    public function admin_count()
    {
        Log::info('Count method hit'); // Log this entry

        try {
            $count = Product::count();
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            Log::error('Error counting products: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error counting products'], 500);
        }
    }
}
