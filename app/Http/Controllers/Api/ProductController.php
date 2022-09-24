<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'type'=>"required|string",
            'price'=>'required|string',
            'quantity'=>"required|string",
            'description'=>'required|string',
            //'photo'=>'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error'=>$validator->errors(),400
            ]);
        }
        //convert base64 to image string
        // if($request->photo != ""){
        //     $strpos=strpos($request->photo,0);
        //     $sub=substr($request->photo,0,$strpos);
        //     $ex=explode('/',$sub)[1];
        //     $name=time().".".$ex;
        //     $img=Image::make($request->photo)->resize(117,100);
        //     $upload_path=public_path()."./upload/";
        //     $img->save($upload_path.$name);
        // }
        // else{
        //     return response()->json([
        //         'error'=>'File Doesnt Exists'
        //     ]);
        // }

        if($request->file('photo'))
        {
            $file=$request->file('photo');
            $photo=$file->store('Product');

            $data=Product::Create([
                'name'=>$request->name,
                'type'=>$request->type,
                'price'=>$request->price,
                'quantity'=>$request->quantity,
                'photo'=>$photo,
                'description'=>$request->description
            ]); 

            return response()->json([
               'success'=>'Product successfully created',
               'data'=>$data,
            ]);
        }      

        
        
    }
}
