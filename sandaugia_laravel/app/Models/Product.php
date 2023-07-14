<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    public $timestamps = false;
    protected $fillable=['product_id','product_name','image','content','price','date_start','date_end','category_id','user_end'];
    public function Category()
    {
        return $this->belongsTo(Category::class,"category_id","category_id");
    } 
    public function Auction()
    {
        return $this->hasMany(Auction::class,"product_id","product_id");
    }
}
