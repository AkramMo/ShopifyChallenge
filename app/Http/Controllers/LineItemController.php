<?php

namespace App\Http\Controllers;

use App\LineItem;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LineItemController extends Controller
{
       
    /**
     * Create line_item and store it
     */
    public function create(Request $request){

        $lineItem = LineItem::createLineItem($request);

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

    /**
     * Return the line_item according to the ID
     * @return LineItem
     */
    public function read(Request $request){


        $lineItem = LineItem::readLineItem($request);

        if($lineItem){
            return response()->json([
                'message' => 'success',
                'lineItem' => $lineItem
            ], 200);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }
    
    /**
     * Update the line item according to the ID
     */
    public function update(Request $request){

        $lineItem = LineItem::editLineItem($request);

        if($lineItem){
            return response()->json([
                'message' => 'success',
                'lineItem' => $lineItem
            ], 200);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }

    /**
     * Delete the line item directly into the DB
     */
    public function delete(Request $request){


        $bool = LineItem::deleteLineItem($request);

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
