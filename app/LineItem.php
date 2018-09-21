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
        'total',
        'shop_id',
        'orders_id',
        'price',
        'total',
    ];

    public static function createLineItem($data){

        return DB::transaction(function () use ($data){
            try {

                $product = Product::find($data['product_id']);

                $lineItem = LineItem::create([
                    'product_id' => $data['product_id'],
                    'orders_id' => $data['orders_id'],
                    'quantity' => $data['quantity'],
                    'price' => $product['price'],
                    'total' => $data['quantity'] * $product['price'],
                ]);
                
                Order::updateOrderTotal($data);

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
