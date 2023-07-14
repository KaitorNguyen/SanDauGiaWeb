@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="text-divider">Thông tin thêm loại sản phẩm</h2>
    <form method="POST" action="{{route('insertCategory')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="categoryname">Nhập loại sản phẩm</label>
            <input type="text" name="categoryname" id="categoryname" class="form-control" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Vui lòng nhập thông tin.</div>
        </div>
        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<div class="container-fluid">
    @if (Session::has('thongbao'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session::get('thongbao')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h2 class="text-divider">Danh sách loại sản phẩm</h2>
    <table class="table table-striped" style="margin: auto; width: 50%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Loại sản phẩm</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $c)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$c->category_name}}</td>
                <td>
                    <a href="{{route('editCategory', ['CategoryID'=>$c->category_id])}}" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalEditCategory{{$c->category_id}}">
                        <i class="fas fa-edit"></i> Cập nhật
                    </a>
    
                    <a href="{{route('deleteCategory', ['CategoryID'=>$c->category_id])}}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModalDeleteCategory{{$c->category_id}}">
                        <i class="fas fa-trash-alt"></i> Xóa
                    </a>
    
                    <!-- The Modal Edit Category -->
                    <div class="modal" id="myModalEditCategory{{$c->category_id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="text-divider">Cập nhật thông tin loại sản phẩm</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                    
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{route('updateCategory', ['CategoryID'=>$c->category_id])}}" enctype="multipart/form-data">
                                        {{method_field('PUT')}}
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="categoryname">Loại sản phẩm</label>
                                            <input type="text" name="categoryname" id="categoryname" value="{{$c->category_name}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button style="cursor:pointer" type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                    
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                    
                            </div>
                        </div>
                    </div>
    
                    <!-- The Modal Delete Category -->
                    <div class="modal" id="myModalDeleteCategory{{$c->category_id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="text-divider">Xóa thông tin loại sản phẩm</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                    
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="GET" action="{{route('deleteCategory', ['CategoryID'=>$c->category_id])}}" enctype="multipart/form-data">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <h5>Bạn có chắc chắn muốn xóa loại sản phẩm: {{$c->category_name}}</h5>
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
        {{$category->links()}}
    </div>
</div>

@endsection