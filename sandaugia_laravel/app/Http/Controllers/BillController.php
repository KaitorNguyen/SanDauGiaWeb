<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Product;
use App\Models\Auction;

class BillController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProductAuction()
    {
        $date = new Carbon(); //Lấy ngày hiện tại
        $user_id =  Auth::id();
        $product = Product::where('user_end', $user_id)->get();

        // $auction = Auction::all();
        $bills = Bill::all();
        return view('cart', compact('product', 'bills'));
    }

    public function addBill($id)
    {
        $auction_max = Auction::where("product_id", $id)->max('auction_price');
        $auction = Auction::where("auction_price",$auction_max)->where("product_id", $id)->first();
        return view('payment', compact('auction'));
    }

    public function insertBill(Request $request, $id)
    {
        $date = new Carbon(); //Lấy ngày hiện tại
        $auction_max = Auction::where("product_id", $id)->max('auction_price');
        $auction = Auction::where("auction_price",$auction_max)->where("product_id", $id)->first();

        $bill = Bill::create([
            'auction_id' => $auction->user_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'date_payment' => $date,
        ]);

        if($bill)
        {
            // Cập nhật trạng thái sản phẩm: active: true Đã thanh toán
            Product::where("product_id", $id)->update([
                'product_id' => $id,
                'active' => true
            ]);
        }
        return redirect()->route('getCarts')->with('thongbao', 'Thanh toán thành công');
    }
}
