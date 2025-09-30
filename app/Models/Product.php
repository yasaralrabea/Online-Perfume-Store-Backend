<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
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
