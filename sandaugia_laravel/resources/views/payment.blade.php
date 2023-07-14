@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h4 class="text-divider">Thanh toán sản phẩm</h4>
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
    

    <table class="table">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Giá mua</th>
                <th>Hình sản phẩm</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$auction->Product->product_id}}</td>
                <td>{{$auction->Product->product_name}}</td>
                <td>{{$auction->Product->Category->category_name}}</td>
                <td> @php echo number_format($auction->auction_price); @endphp VNĐ </td>
                <td>
                    <img src="images/{{$auction->Product->image}}" width="75" height="60" style="object-fit: contain;">
                </td>
            </tr> 
        </tbody>
    </table>
    <div>
        <h3>Thông tin nhận hàng</h3>
    </div>
    <form method="POST" action="{{route('insertBill', ['ProductID'=>$auction->Product->product_id])}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" id="name" placeholder="Nhập tên người nhận" name="name">
          <label for="name">Họ và tên</label>
          @if ($errors->has('name'))
          <span class="text-danger">{{ $errors->first('name') }}</span>
          @endif
        </div>
        <div class="form-floating mt-3 mb-3">
          <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ người nhận" name="address">
          <label for="address">Địa chỉ</label>
          @if ($errors->has('address'))
          <span class="text-danger">{{ $errors->first('address') }}</span>
          @endif
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại người nhận" name="phone">
            <label for="phone">Số điện thoại</label>
            @if ($errors->has('phone'))
            <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <h3>Tổng số tiền: @php echo number_format($auction->auction_price); @endphp VNĐ </h3>
        </div>
        <div class="form-group d-flex justify-content-end">
            <button style="cursor:pointer" type="submit" class="btn btn-color">Thanh toán</button>
        </div>
    </form>
</div>
@endsection