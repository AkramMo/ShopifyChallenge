<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Order;
use App\Product;

class LineItem extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'line_item';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    protected $fillable = [
        'quantity',
        'product_id',
        'orders_id',
        'price',
        'total',
    ];

    public static function createLineItem($data){

        return DB::transaction(function () use ($data){
            try {

                $product = Product::where('id',$data['product_id'])->first();
                $total = $data['quantity'] * $product['price'];

                $lineItem = LineItem::create([
                    'orders_id' => $data['orders_id'],
                    'product_id' => $data['product_id'],
                    'quantity' => $data['quantity'],
                    'price' => $product['price'],
                    'total' => $total,
                ]);
             
         
                
                $order = Order::where('id', $data['orders_id'])->first();
              
            
                $orderTotal = LineItem::where('orders_id', $data['orders_id'])
                        ->sum('total');

                $order->total = $orderTotal;            
            
                $order->save(); 

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

                $lineItem = LineItem::where('id',$data['id'])->first();

                $lineItem->quantity = $data['quantity'];
                $lineItem->price = $data['price'];
                $lineItem->total = $data['total'];
            
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

                $lineItem = LineItem::where('id',$data['id'])->first();


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
