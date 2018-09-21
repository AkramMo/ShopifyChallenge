<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ShopController extends Controller
{
    public function create(Request $request){


        $shop = Product::createShop($request);

        if($shop){
            return response()->json([
                'message' => 'success',
                'shop' => $shop
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function read(Request $request){


        $shop = Product::readShop($request);

        if($shop){
            return response()->json([
                'message' => 'success',
                'shop' => $shop
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function update(Rquest $request){

        $shop = Product::editShop($request);

        if($shop){
            return response()->json([
                'message' => 'success',
                'shop' => $shop
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function delete(Request $request){


        $bool = Product::deleteShop($request);

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
