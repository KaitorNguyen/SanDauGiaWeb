<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        // $category = Category::all();
        $category = Category::paginate(10);
        return view('admin.listcategory', compact('category'));
    }

    public function insertCategory(Request $request)
    {
        $category = Category::create([
            'category_name' => $request->categoryname
        ]);
        return redirect()->route('listCategory')->with('thongbao', 'Thêm loại sản phẩm thành công');
    }

    public function editCategory($id)
    {
        $category = Category::where("category_id", $id)->first();
        return view('admin.listcategory', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::where("category_id", $id);
        $category->update([
            'category_id' => $id,
            'category_name' => $request->categoryname
        ]);
        return redirect()->route('listCategory')->with('thongbao', 'Cập nhật loại sản phẩm thành công');
    }

    public function deleteCategory($id)
    {
        Category::where("category_id", $id)->delete();
        return redirect()->route('listCategory')->with('thongbao', 'Xóa loại sản phẩm thành công');
    }

    public function getCategoryProduct($name)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $category = Category::where("category_name", $name)->first();
        $products = Product::where("category_id", $category->category_id)->paginate(2);
        return view('categoryproduct', compact('categories', 'products'));
    }
}
