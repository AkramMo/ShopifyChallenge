<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Shop extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop';

      /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
      
    /**
     * Create line_item and store it
     */
    public static function createShop($data){

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
        return DB::transaction(function () use ($data){
            try {

                $shop = Shop::create([
                    'name' => $data['name'],
                ]);

                return $shop;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    /**
     * Edit an existing shop
     */
    public static function editShop($data){

        return DB::transaction(function () use ($data){
            try {

                $shop = Shop::find($data['id']);

                $shop->name = $data['name'];

                $shop->save();


                return $shop;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    /**
     * Return a shop according to his ID
     */
    public static function readShop($data){

        return DB::transaction(function () use ($data){
            try {

                $shop = Shop::find($data['id']);


                return $shop;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    /**
     * Return all the orders from a specific shop ID
     */
    public static function readShopOrder($data){

        return DB::transaction(function () use ($data){
            try{

                return Order::where('shop_id', $data['id'])->get();

                
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    /**
     * Delete a shop function
     */
    public static function deleteShop($data){

        return DB::transaction(function () use ($data){
            try {

                $shop = Shop::find($data['id']);

                $shop->delete();

                return true;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

}
