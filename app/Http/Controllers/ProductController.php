<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
       
    public function create(Request $request){


        $product = Product::createProduct($request);

        if($product){
            return response()->json([
                'message' => 'success',
                'product' => $product
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function read(Request $request){


        $product = Product::readProduct($request);

        if($product){
            return response()->json([
                'message' => 'success',
                'product' => $product
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function update(Rquest $request){


        $product = Product::editProduct($request);

        if($product){
            return response()->json([
                'message' => 'success',
                'product' => $product
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function delete(Request $request){


        $bool = Product::deleteProduct($request);

        if($bool){
            return response()->json([
                'message' => 'success'
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }
}
