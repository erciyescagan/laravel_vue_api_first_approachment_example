<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Review;
use App\Http\Resources\ProductResource;

class ReviewController extends Controller
{
    public function store(Request $request, Products $product){
        $product->reviews()->create([
            'title' => $request->title,
            'body' => $request->body,
            'rating' => $request->rating,
            'user_id' => $request->user_id,
            'product_id' => $product->id
        ]);

        return ProductResource::make($product->load('reviews'));
    }

    public function update(Request $request, Products $product, Review $review){
        
        $product->reviews()->find($review->id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'rating' => $request->rating,
            'user_id' => $request->user_id,
            'product_id' => $product->id
        ]);

        return ProductResource::make($product->load('reviews'));
    }

    public function delete(Request $request, Products $product){
        $review = Review::find($request->review_id);
        $review->delete();

        return ProductResource::make($product->load('reviews'));

    }
}
