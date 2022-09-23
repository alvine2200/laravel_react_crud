<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        $file=$request->file('photo');
        $photo=$file->store('Images/Photo');

        $data=Product::firstOrCreate([
            'name'=>$request->name,
            'type'=>$request->type,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'photo'=>$photo,
            'description'=>$request->description
        ]);
        
    }
}
