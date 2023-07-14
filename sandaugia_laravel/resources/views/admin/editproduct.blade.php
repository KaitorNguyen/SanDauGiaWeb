@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h4 class="text-divider">Cập nhật sản phẩm đấu giá</h4>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{route('updateProduct', ['ProductID'=>$product->product_id])}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        {{csrf_field()}}

        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" id="productname" placeholder="Nhập tên sản phẩm" value="{{$product->product_name}}" name="productname">
          <label for="productname">Tên sản phẩm</label>
        </div>
        <div class="form-floating mt-3 mb-3">
          <input type="text" class="form-control" id="price" placeholder="Nhập giá khởi điểm" value="{{$product->price}}" name="price">
          <label for="price">Giá khởi điểm</label>
        </div>
        <div class="form-floating">
            <select class="form-select" id="categories" name="categories">
                @foreach($category as $c)
                <option value="{{$c->category_id}}">{{$c->category_name}}</option>
                @endforeach
            </select>
            <label for="sel1" class="form-label">Lựa chọn loại sản phẩm</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="textarea" class="form-control" id="content" placeholder="Mô tả sản phẩm" value="{{$product->content}}" name="content" style="height: 100px">
            <label for="content">Mô tả sản phẩm</label>
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="datetime-local" class="form-control" id="datestart" value="{{$product->date_start}}" name="datestart">
            <label for="datestart">Ngày bắt đầu</label>
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="datetime-local" class="form-control" id="dateend" value="{{$product->date_end}}" name="dateend">
            <label for="dateend">Ngày kết thúc</label>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Hình sản phẩm</label>
            <input class="form-control" type="file" id="fileUpload" name="fileUpload">
            <img src="images/{{$product->image}}" width="75" height="60" style="object-fit: contain;">
        </div>
        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection