<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $table = "auctions";
    public $timestamps = false;
    protected $fillable=['auction_id','user_id','product_id','auction_price','auction_date'];
    public function User()
    {
        return $this->belongsTo(User::class,"user_id","id");
    } 
    public function Product()
    {
        return $this->belongsTo(Product::class,"product_id","product_id");
    } 
    public function Bill()
    {
        return $this->hasOne(Bill::class,"bill_id","bill_id");
    }
}
