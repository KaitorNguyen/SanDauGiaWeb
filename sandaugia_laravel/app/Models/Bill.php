<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = "bills";
    public $timestamps = false;
    protected $fillable=['bill_id','auction_id','name','address','phone','date_payment'];
    public function Auction()
    {
        return $this->belongsTo(Auction::class,"auction_id","auction_id");
    }
}
