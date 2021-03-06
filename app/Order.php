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
    
    /**
     * Create an new Order
     */
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

    /**
     * Update the total of an Order according
     * to the his line items
     */
    public static function updateOrderTotal($data){

        return DB::transaction(function () use ($data){
            try {


                $order = Order::where('id', $data['shop_id'])->first();

                $total = LineItem::where('orders_id', $order->id)
                            ->sum('total');

                $order->total = $total;     
                
                $order->save();

                return $order;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }
    
    /**
     * Update an existing order
     */
    public static function editOrder($data){

        return DB::transaction(function () use ($data){
            try {


                $order = Order::where('id', $data['shop_id'])->first();

                $order->total = $data['total'];
                
            
                $order->save();

                return $order;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    /**
     * Return an order according to his ID
     */
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

  
    public static function deleteOrder($data){

        return DB::transaction(function () use ($data){
            try {

                $order = Order::where('id', $data['id'])->first();

                return $order->delete();
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

}
