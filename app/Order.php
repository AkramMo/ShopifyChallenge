<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'total',
        'shop_id',
    ];
    
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


                $order = Order::find($data['orders_id']);

                $total = LineItem::where('orders_id', $data['orders_id'])
                        ->sum('total');

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

                $order = Order::find($data['orders_id']);

                $order->delete();

                return true;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

}
