<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
    public function av_rates()
    {
        return $this->rates()->avg('rating');
    }

    public function ratesCount()
{
    return $this->rates()->count();
}

    public function received() {
    return $this->hasMany(ReceivedProduct::class);
}
    protected $guarded = [];

}
