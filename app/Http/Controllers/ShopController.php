<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ShopController extends Controller
{
    /**
     * Create a shop
     */
    public function create(Request $request){


        $shop = Shop::createShop($request);

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

    /**
     * Return a shop according to his ID
     */
    public function read(Request $request){


        $shop = Shop::readShop($request);

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

    /**
     * Return all the orders according to his shop_id
     */
    public function readShopOrder(Request $request){


        $orders = Shop::readShopOrder($request);

        if($orders){
            return response()->json([
                'message' => 'success',
                'orders' => $orders
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }
   

    /**
     * Modify a shop 
     */
    public function update(Request $request){

        $shop = Shop::editShop($request);

        if($shop){
            return response()->json([
                'message' => 'success',
                'shop' => $shop
            ], 200);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    /**
     * Delete a shop according to his ID
     */
    public function delete(Request $request){


        $bool = Shop::deleteShop($request);

        if($bool){
            return response()->json([
                'message' => 'success'
            ], 200);
        }

        return response()->json([
            'message' => 'error',
        ], 500);

    }
}
