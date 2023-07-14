@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <h2 class="text-divider">Danh sách người dùng</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Chức năng</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $u)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->role}}</td>
                <td>
                    @if ($u->is_active === 1)
                        Đang hoạt động
                    @else
                        Bị khóa
                    @endif
                </td>
                <td>
                    @if ($u->is_active === 1)
                    <a href="{{route('lockUser', ['UserID'=>$u->id])}}"  class="btn btn-sm btn-danger">
                        <i class="fa-solid fa-lock"></i> Khóa tài khoản
                    </a>
                    @else
                    <a href="{{route('lockUser', ['UserID'=>$u->id])}}"  class="btn btn-sm btn-success">
                        <i class="fa-solid fa-lock-open"></i> Mở khóa tài khoản
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-center" style="padding-top: 15px">
        {{$user->links()}}
    </div>
</div>
@endsection