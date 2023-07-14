<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Auction;
use App\Models\Product;

class AuctionController extends Controller
{
    public function insertAuction(Request $request, $id)
    {
        $date = new Carbon(); //Lấy ngày hiện tại

        if (Auth::user()->role == 'Customer' && Auth::user()->is_active == 1)
        {
            $product = Product::where('product_id', $id)->first();
            if (strtotime($product->date_end) >= strtotime($date) && strtotime($product->date_start) <= strtotime($date) )
            {
                $auction_max =  Auction::where("product_id", $id)->get()->max('auction_price');
                if ($request->auction_price < $auction_max )
                {
                    return redirect()->route('detailProduct', ['ProductID'=>$id])->with('thongbao', 'Giá nhập vào phải lớn hơn giá hiện tại');
                }
                else
                {
                    $auction = Auction::create([
                        'user_id' =>  Auth::id(),
                        'product_id' => $id,
                        'auction_price' => $request->auction_price,
                        // 'auction_date' => $request ->aution_date
                        'auction_date' => $date,
                    ]);
                    return redirect()->route('detailProduct', ['ProductID'=>$id]);
                }
            }
            else if (strtotime($product->date_start) >= strtotime($date))
            {
                return redirect()->route('detailProduct', ['ProductID'=>$id])->with('thongbao', 'Phiên đấu giá chưa bắt đầu');
            } 
            else
            {
                return redirect()->route('detailProduct', ['ProductID'=>$id])->with('thongbao', 'Phiên đấu giá đã kết thúc');
            }
        }
        else
        {
            return redirect()->route('detailProduct', ['ProductID'=>$id])->with('thongbao', 'Tài khoản của bạn không được phép đấu giá');
        }
    }
}
