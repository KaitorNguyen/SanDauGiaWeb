@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h4 class="text-divider">Thêm sản phẩm đấu giá</h4>
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form method="POST" action="{{route('insertProduct')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" id="productname" placeholder="Nhập tên sản phẩm" name="productname">
          <label for="productname">Tên sản phẩm</label>
          @if ($errors->has('productname'))
          <span class="text-danger">{{ $errors->first('productname') }}</span>
          @endif
        </div>
        <div class="form-floating mt-3 mb-3">
          <input type="text" class="form-control" id="price" placeholder="Nhập giá khởi điểm" name="price">
          <label for="price">Giá khởi điểm</label>
          @if ($errors->has('price'))
          <span class="text-danger">{{ $errors->first('price') }}</span>
          @endif
        </div>
        <div class="form-floating">
            <select class="form-select" id="categories" name="categories">
                @foreach($category as $c)
                <option value="{{$c->category_id}}">{{$c->category_name}}</option>
                @endforeach
            </select>
            <label for="sel1" class="form-label">Lựa chọn loại sản phẩm</label>
            @if ($errors->has('categories'))
            <span class="text-danger">{{ $errors->first('categories') }}</span>
            @endif
        </div>
        <div class="form-floating mb-3 mt-3">
            <textarea class="form-control" id="content" placeholder="Mô tả sản phẩm" name="content" style="height: 100px"></textarea>
            <label for="content">Mô tả sản phẩm</label>
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="datetime-local" class="form-control" id="datestart" placeholder="Nhập giá khởi điểm" name="datestart">
            <label for="datestart">Ngày bắt đầu</label>
            @if ($errors->has('datestart'))
            <span class="text-danger">{{ $errors->first('datestart') }}</span>
            @endif
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="datetime-local" class="form-control" id="dateend" placeholder="Nhập giá khởi điểm" name="dateend">
            <label for="dateend">Ngày kết thúc</label>
            @if ($errors->has('dateend'))
            <span class="text-danger">{{ $errors->first('dateend') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Hình sản phẩm</label>
            <input class="form-control" type="file" id="fileUpload" name="fileUpload">
            @if ($errors->has('fileUpload'))
            <span class="text-danger">{{ $errors->first('fileUpload') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection