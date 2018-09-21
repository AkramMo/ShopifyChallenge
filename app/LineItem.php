<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'line_item';

    public static function createLineItem($data){

        return DB::transaction(function () use ($data){
            try {

                $lineItem = LineItem::create([
                    'product_id' => $data['product_id'],
                    'orders_id' => $data['orders_id'],
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                ]);

                return $lineItem;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function editLineItem($data){

        return DB::transaction(function () use ($data){
            try {

                $lineItem = LineItem::find($data['id']);

                $lineItem->quantity = $data['quantity'];
                $lineItem->price = $data['price'];
            
                $lineItem->save();


                return $lineItem;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function readLineItem($data){

        return DB::transaction(function () use ($data){
            try {

                $lineItem = LineItem::find($data['id']);


                return $lineItem;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function deleteLineItem($data){

        return DB::transaction(function () use ($data){
            try {

                $lineItem = LineItem::find($data['id']);

                $lineItem->delete();

                return true;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

}
