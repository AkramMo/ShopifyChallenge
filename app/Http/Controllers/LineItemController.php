<?php

namespace App\Http\Controllers;

use App\LineItem;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LineItemController extends Controller
{
       
 
    public function create(Request $request){


        $lineItem = Product::createLineItem($request);

        if($lineItem){
            return response()->json([
                'message' => 'success',
                'lineItem' => $lineItem
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function read(Request $request){


        $lineItem = Product::readLineItem($request);

        if($lineItem){
            return response()->json([
                'message' => 'success',
                'lineItem' => $lineItem
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function update(Rquest $request){

        $lineItem = Product::editLineItem($request);

        if($lineItem){
            return response()->json([
                'message' => 'success',
                'lineItem' => $lineItem
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function delete(Request $request){


        $bool = Product::deleteLineItem($request);

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
