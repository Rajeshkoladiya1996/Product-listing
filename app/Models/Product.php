<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'id','cat_id','name', 'discription','minqty','maxqty','price','image','status'
    ];


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'cat_id')->with(['parent','children']);
    }


}
