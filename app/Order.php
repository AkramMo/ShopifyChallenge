<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    
    public static function createOrder($data){

        return DB::transaction(function () use ($data){
            try {

                $order = Order::create([
                    'shop_id' => $data['shop_id'],
                    'total' => null,
                ]);

                return $order;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function updateOrderTotal($data){

        return DB::transaction(function () use ($data){
            try {


                $order = Order::find($data['id']);

                $total = LineItem::where('order_id', $data['id'])
                        ->sum('price');

                $order->total = $total;            
            
                $order->save();


                return $lineItem;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function readOrder($data){

        return DB::transaction(function () use ($data){
            try {

                $order = Order::find($data['id']);


                return $order;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function readShopOrder($data){

        return DB::transaction(function () use ($data){
            try{

                $allOrder = Order::where('shop_id', $data['shop_id'])->get();

                return $allOrder;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function deleteOrder($data){

        return DB::transaction(function () use ($data){
            try {

                $order = Order::find($data['id']);

                $order->delete();

                return true;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

}
