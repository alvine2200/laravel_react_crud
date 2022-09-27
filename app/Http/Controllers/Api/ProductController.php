<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function getproducts()
    {
        $products = Product::all();
        $resource = ProductResource::collection($products);
        return response()->json([
            'success' => 'Products fetched successfully',
            'products' => $resource,
        ], 200);
    }
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => "required|string",
            'price' => 'required|string',
            'quantity' => "required|string",
            'description' => 'required|string',
            'photo' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(), 400
            ]);
        }

        if ($file = $request->file('photo')) {
            $filename = uniqid() . $file->getClientOriginalName();
            $photo = $request->file('photo')->storePubliclyAs('public', $filename);

            $data = Product::Create([
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'photo' => $photo,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => 'Product successfully created',
                'data' => $data,
            ]);
        }
    }
}
