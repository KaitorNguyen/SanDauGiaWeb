@extends('layouts.app')
@section('content')
<div class="container-fluid">
    @if (Session::has('thongbao'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session::get('thongbao')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h2 class="text-divider">Danh sách sản phẩm đấu giá thành công</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Hình sản phẩm</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $p)
            @if ($p->active == 0)
            <tr>
                <td>{{$p->product_id}}</td>
                <td>{{$p->product_name}}</td>
                <td>{{$p->Category->category_name}}</td>
                <td>
                    <img src="images/{{$p->image}}" width="75" height="60" style="object-fit: contain;">
                </td>
                <td>
                    <a href="{{route('addBill', ['ProductID'=>$p->product_id])}}" class="btn btn-success" style="font-weight: 600">
                        <i class="fas fa-edit"></i> Thanh toán
                    </a>
                </td>
            </tr> 
            @endif
            @endforeach
        </tbody>
    </table>

    <h2 class="text-divider">Lịch sử thanh toán</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Hình sản phẩm</th>
                <th>Người nhận</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Ngày thanh toán</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $b)
            @if ($b->Auction->user_id == Auth::id())
            <tr>
                <td>{{$b->Auction->Product->product_id}}</td>
                <td>{{$b->Auction->Product->product_name}}</td>
                <td>{{$b->Auction->Product->Category->category_name}}</td>
                <td>
                    <img src="images/{{$b->Auction->Product->image}}" width="75" height="60" style="object-fit: contain;">
                </td>
                <td>{{$b->name}}</td>
                <td>{{$b->address}}</td>
                <td>{{$b->phone}}</td>
                <td> @php echo date("d-m-Y g:i a", strtotime($b->date_payment)); @endphp </td>
            </tr> 
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection