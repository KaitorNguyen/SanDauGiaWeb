@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container text-center">
        @if (Session::has('thongbao'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session::get('thongbao')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- <h1>Thông tin sản phẩm {{$product->product_name}}</h1> --}}
        <div class="row" style="margin-top: 25px">
            <div class="col-7">
                <h3>Thông tin sản phẩm</h3>
                <div class="row" style="margin-top: 25px">
                    <div class = "col-md-5 me-auto">
                        <img src="images/{{$product->image}}" width="250" style="object-fit: contain; margin: 0px auto;">
                    </div>
                    <div class = "col-md-7 me-auto">
                        <div class="row">
                            <div class="col-6 text-left">
                                <h5>Tên sản phẩm</h5>
                                <h5>Loại</h5>
                                <h5>Mô tả</h5>
                                <h5>Giá khởi điểm</h5>
                                <h5>Giá hiện tại</h5>
                                <h5>Ngày bắt đầu</h5>
                                <h5>Ngày kết thúc</h5>
                            </div>
                            <div class="col-6 text-left">
                                <h5>{{$product->product_name}}</h5>
                                <h5>{{$product->Category->category_name}}</h5>
                                <h5>{{$product->content}}</h5>
                                <h5> @php echo number_format($product->price); @endphp VNĐ </h5>
                                @if ($auction_max == 0)
                                    <h5> @php echo number_format($product->price); @endphp VNĐ </h5>
                                @else
                                    <h5> @php echo number_format($auction_max); @endphp VNĐ</h5>
                                @endif
                                <h5> @php echo date("d-m-Y g:i a", strtotime($product->date_start)); @endphp </h5>
                                <h5> @php echo date("d-m-Y g:i a", strtotime($product->date_end)); @endphp </h5>
                            </div>
                            {{-- <div>
                                <tr style="justify-content: end; ">
                                    <td style="color:red; background-color:white; padding-bottom: 15px;">Cooldown: </td>
                                    <td style="background-color:white">{{$product->date_end}}</td>
                                </tr>
                            </div> --}}
                            <div style="margin-top: 25px">
                                <form method="POST" action="{{route('insertAuction', ['ProductID'=>$product->product_id])}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="auction_price" id="auction_price" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Vui lòng nhập thông tin.</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button style="cursor:pointer" type="submit" class="btn btn-primary">
                                                <i class="fa fa-gavel" aria-hidden="true"></i> Đấu giá
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class = "col-md-5">
                <h3>Lịch sử đấu giá</h3>
                <table class="table" style="margin-top: 25px">
                    <thead>
                        <th scope="col">STT</th>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Giá mua</th>
                        <th scope="col">Thời gian</th>
                    </thead>
                    <tbody> 
                        @foreach ($auction as $a)
                        <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$a->User->name}}</td>
                            <td>
                                @php 
                                    echo number_format($a->auction_price); 
                                @endphp
                            </td>
                            <td>
                                @php
                                    echo date("d-m-Y H:i:s", strtotime($a->auction_date));
                                @endphp
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-center" style="padding-top: 15px">
                    {{$auction->links()}}
                </div>
            </div>
            {{-- <div class="col-4" style="width: 32%">
                <img src="images/{{$product->image}}" width="250" style="object-fit: contain;">
            </div>
            <div class="col-8" style="width: 68%;height: 800px">
                <div style="height: 80%">
                    <div class="row">
                        <div style="width:60%;">
                            <h3>Thông tin sản phẩm</h3>
                            <div class="row">
                                <div class="col-6 text-left">
                                    <h4>Mô tả</h4>
                                    <h4>Giá khởi điểm</h4>
                                    <h4>Ngày bắt đầu</h4>
                                    <h4>Ngày kết thúc</h4>
                                </div>
                                <div class="col-6">
                                    <h4>{{$product->content}}</h4>
                                    <h4>{{$product->price}}</h4>
                                    <h4>{{$product->date_start}}</h4>
                                    <h4>{{$product->date_end}}</h4>
                                </div>
                            </div>
                        </div>
                        <div style="background:white; width:40%;">
                            <h3>Lịch sử đấu giá</h3>
                            <table class="table">
                                <thead>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Giá mua</th>
                                    <th scope="col">Thời gian</th>
                                </thead>
                                <tbody>
                                    @foreach ($auction as $a)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$a->User->name}}</td>
                                        <td>{{$a->auction_price}}</td>
                                        <td>{{$a->auction_date}}</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="background:gray; height: 10%">
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection