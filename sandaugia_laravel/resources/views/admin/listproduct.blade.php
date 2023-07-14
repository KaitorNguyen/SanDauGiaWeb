@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <a href="{{route('addProduct')}}" class="btn btn-sm btn-primary">
        <i class="fa-solid fa-plus"></i> Thêm sản phẩm
    </a>

    <h2 class="text-divider">Danh sách sản phẩm đấu giá</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Giá khởi điểm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Hình sản phẩm</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $p)
            <tr>
                <td>{{$p->product_id}}</td>
                <td>{{$p->product_name}}</td>
                <td>{{$p->Category->category_name}}</td>
                <td>{{$p->price}}</td>
                <td>{{$p->date_start}}</td>
                <td>{{$p->date_end}}</td>
                <td>
                    <img src="images/{{$p->image}}" width="75" height="60" style="object-fit: contain;">
                </td>
                <td>
                    <a href="{{route('editProduct', ['ProductID'=>$p->product_id])}}" class="btn btn-sm btn-success">
                        <i class="fas fa-edit"></i> Cập nhật
                    </a>
    
                    <a href="{{route('deleteProduct', ['ProductID'=>$p->product_id])}}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModalDeleteProduct{{$p->product_id}}">
                        <i class="fas fa-trash-alt"></i> Xóa
                    </a>

                    <!-- The Modal Delete Product -->
                    <div class="modal" id="myModalDeleteProduct{{$p->product_id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="text-divider">Xóa thông tin sản phẩm</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                    
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="GET" action="{{route('deleteProduct', ['ProductID'=>$p->product_id])}}" enctype="multipart/form-data">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <h5>Bạn có chắc chắn muốn xóa sản phẩm: {{$p->product_name}}</h5>
                                        <div class="modal-footer" style="justify-content: center">
                                            <button style="cursor:pointer" type="submit" class="btn btn-primary">Đồng ý</button>
                                            <button type="button" class="btn btn-danger" style="margin-left: 20px" data-dismiss="modal">Không đồng ý</button>
                                        </div>
                                    </form>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-center" style="padding-top: 15px">
        {{$product->links()}}
    </div>
</div>
@endsection