<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class OrderController extends Controller
{
       
    public function create(Request $request){


        $order = Order::createOrder($request);

        if($order){
            return response()->json([
                'message' => 'success',
                'order' => $order
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function read(Request $request){


        $order = Order::readOrder($request);

        if($order){
            return response()->json([
                'message' => 'success',
                'order' => $order
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }
      
    public function updateOrderTotal(Rquest $request){


        $order = Order::updateOrderTotal($request);

        if($order){
            return response()->json([
                'message' => 'success',
                'order' => $order
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function delete(Request $request){

        $bool = Order::deleteOrder($request);

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
