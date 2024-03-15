<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends ApiController
{
    public function search(int $id) 
    {
        $product = Product::select('id', 'thumb', 'name', 'price', 'inventory')->find($id);
        
        if(!$product) {
            return $this->response('Product not found', 404);
        }
        return new ProductResource($product);
    }
}
