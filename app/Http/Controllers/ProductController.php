<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Http\Filters\ProductFilter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = new ProductFilter(new Product());
        $products = $products->apply(request()->query())
                             ->paginate(6);

        $products->each(function($product) {
            $product->thumb = Storage::url($product->thumb);
        });

        return view('components.pages.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        return view('components.pages.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = new Product();
            $product->thumb = $request->file('thumb')->store('/product/thumb');
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->price = $request->price;
            $product->inventory = $request->inventory;
            $product->category = $request->category;
            $product->description = $request->description;
            $product->save();

            $request->session()->put('success', "Product $product->name created successfully."); 
        
        }catch(QueryException $e) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }

        return redirect()->route('product.create');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        
        return view('components.pages.product.update', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            if($request->hasFile('thumb')) {
                $oldThumb = $product->thumb;
                $product->thumb = $request->file('thumb')->store('/product/thumb');
            }
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->price = $request->price;
            $product->inventory = $request->inventory;
            $product->category = $request->category;
            $product->description = $request->description;
            $product->save();

            if(isset($oldThumb) && Storage::has($oldThumb)) {
                Storage::delete($oldThumb);
            }

            $request->session()->put('success', "Product $product->name updated successfully.");
        
        }catch(QueryException $e) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }

        return redirect()->route('product.edit', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $thumb = $product->thumb;
            $product->delete();
            if(Storage::has($thumb)) {
                Storage::delete($thumb);
            }
            request()->session()->put('success', "Product $product->name delete successfully.");

        }catch(QueryException $e) {
            request()->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }

        return redirect()->route('product.index');
    }
}
