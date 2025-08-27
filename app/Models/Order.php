<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

        
    public function received()
     {
         return $this->hasMany(ReceivedProduct::class);
     }

        protected $guarded = [];
        protected $casts = [
       'cart' => 'array',
       ];

}
