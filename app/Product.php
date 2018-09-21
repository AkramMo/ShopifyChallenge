<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
        'shop_id',
        'price',
    ];
      
    public static function createProduct($data){

        return DB::transaction(function () use ($data){
            try {

                $product = Product::create([
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'shop_id' => $data['shop_id'],
                ]);

                return $product;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function editProduct($data){

        return DB::transaction(function () use ($data){
            try {

                $product = Product::find($data['id']);

                $product->name = $data['name'];
                $product->price = $data['price'];
                
                if($data['shop_id'] != null){

                    $product->shop_id = $data['shop_id'];
                }

                $product->save();


                return $product;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function readProduct($data){

        return DB::transaction(function () use ($data){
            try {

                $product = Product::find($data['id']);


                return $product;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function deleteProduct($data){

        return DB::transaction(function () use ($data){
            try {

                $product = Product::find($data['id']);

                $product->delete();

                return true;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    
}
