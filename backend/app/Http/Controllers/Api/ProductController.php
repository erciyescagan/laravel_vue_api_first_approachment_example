<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Products;
class ProductController extends Controller
{
    public function index(){
        return ProductResource::collection(Products::with('reviews')->latest()->get());
    }

    public function show(Products $product){
        return ProductResource::make($product->load('reviews'));
    }
}
