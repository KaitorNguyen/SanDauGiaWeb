<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use App\Models\Product;
use App\Models\Category;
use App\Models\Auction;

class ProductController extends Controller
{
    public function index()
    {
        // $product = Product::all();
        $product = Product::paginate(10);
        return view('admin.listproduct', compact('product'));
    }

    public function showSearchProduct(Request $request)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $keyword = $request->keyword;
        $products = Product::where('product_name', 'like', "%$keyword%")->orwhere('content', 'like', "%$keyword%")->paginate(10);

        return view('search', compact('categories', 'products'));
    }
    public function getProductDetail($id)
    {
        $date = new Carbon(); //Lấy ngày hiện tại

        $product = Product::where("product_id", $id)->first();
        // $auction_user = Auction::where("product_id", $id)->where("auction_date",'<=','04-12-2022 11:47:46')->first();
        // $auction_user = Auction::where("product_id", $id)->first();
        $auction = Auction::where("product_id", $id)->orderBy('auction_date', 'ASC')->paginate(10);
        $auction_max = $auction->max('auction_price');

        if (Auction::where("product_id", $id)->exists()) {
            $auction_user = Auction::where("product_id", $id)->first();
            if(strtotime($product->date_end) <= strtotime($date) && strtotime($auction_user->auction_date) <= strtotime($date))
            {
                Product::where("product_id", $id)->update([
                    'product_id' => $id,
                    'user_end' => Auction::where("auction_price",$auction_max)->where("product_id", $id)->first()->user_id
                ]);
            }
        }

        return view("detailproduct", compact('product', 'auction', 'auction_max'));
    }

    public function addProduct()
    {
        $category = Category::all();
        return view('admin.addproduct', compact('category'));
    }

    public function insertProduct(Request $request)
    {
        $validatedData = $request->validate([
            'productname' =>'required|max:255',
            'price' =>'required|numeric|min:0',
            'categories' =>'required|numeric|exists:categories,category_id',
            'datestart' =>'required|date|after_or_equal:' . date(DATE_ATOM),
            'dateend' =>'required|date|after_or_equal:' . date(DATE_ATOM),
            'fileUpload' =>'required|mimes:jpeg,png,jpg,gif,svg'
        ], [
            'productname.required' =>'Vui lòng nhập tên sản phẩm',
            'price.required' =>'Vui lòng nhập giá khởi điểm',
            'categories.required' =>'Vui lòng chọn loại sản phẩm',
            'datestart.required' =>'Vui lòng chọn ngày bắt đầu',
            'dateend.required' =>'Vui lòng chọn ngày kết thúc',
            'fileUpload.required' =>'Vui lòng chọn ảnh sản phẩm',
        ]);

        $filename = "";
        // Kiểm tra người dùng có Upload File không
        if ($request->hasFile('fileUpload')) 
        {
            $filename = $request->file('fileUpload')->getClientOriginalName();
            $filename = time().'_'.$filename;
            $request->fileUpload->move('images/', $filename);
        }
        $product = Product::create([
            'product_name' => $request->productname,
            'price' => $request->price,
            'category_id' => $request->categories,
            'content' => $request->content,
            'date_start' => $request->datestart,
            'date_end' => $request->dateend,
            'image' => $filename
        ]);
        $product = Product::all();
        return redirect()->route('listProduct');
    }

    public function editProduct($id)
    {
        $product = Product::where("product_id", $id)->first();
        $category = Category::all();
        return view('admin.editproduct', compact('product', 'category'));  
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::where("product_id", $id)->first();

        // Kiểm tra người dùng có Upload File không
        if ($request->hasFile('fileUpload')) 
        {
            // $destination = public_path("images/".$product->image);
            if (file_exists(public_path("images/".$product->image)))
            {
                unlink(public_path("images/".$product->image));
            }

            $filename = $request->file('fileUpload')->getClientOriginalName();
            $filename = time().'_'.$filename;
            $request->fileUpload->move('images/', $filename);
        } else {
            $filename = $product->image;
        }

        Product::where("product_id", $id)->update([
            'product_id' => $id,
            'product_name' => $request->productname,
            'price' => $request->price,
            'category_id' => $request->categories,
            'content' => $request->content,
            'date_start' => $request->datestart,
            'date_end' => $request->dateend,
            'image' => $filename
        ]);
        return redirect()->route('listProduct');
    }

    public function deleteProduct($id)
    {
        $record = Product::where("product_id", $id)->first();
        if (file_exists(public_path("images/".$record->image)))
        {
            unlink(public_path("images/".$record->image));
        }
        Product::where("product_id", $id)->delete();
        $product = Product::all();
        return redirect()->route('listProduct');
    }

    public function coolDown () {
        //VD:  5/11/2022
        $target = mktime(0,0,0,11,5,2022) ;
        $today = time(); // thiet lap ngay hien tai
        $cooldown = ($target - $today);
        $day = (int) ($cooldown / 86400);
    }

}
