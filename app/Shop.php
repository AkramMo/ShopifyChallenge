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
