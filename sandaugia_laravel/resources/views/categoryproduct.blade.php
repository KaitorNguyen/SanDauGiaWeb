@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container text-center">
        <div class="row justify-content-center" style="margin-bottom: 25px">
            <form method="GET" action="{{route('searchProducts')}}">
                <label for="gsearch">Search Product:</label>
                <input type="search" id="keyword" name="keyword">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Categories
                    </div>
                    <ul class="list-group list-group-flush">
                        <a href="{{route('allProduct')}}" style="text-decoration: none">
                            <li class="list-group-item">All Product</li>
                        </a>
                        @foreach($categories as $c)
                            <a href="{{route('getCategoryProduct', ['CategoryName' => $c->category_name])}}" style="text-decoration: none">
                                <li class="list-group-item"> {{$c->category_name}}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $p)
                    <div class="col">
                        <div class="card">
                          <img src="images/{{$p->image}}" width="150" height="150" class="card-img-top" style="object-fit: contain; margin-top: 15px" alt="{{$p->product_name}}">
                          <div class="card-body">
                            <h5 class="card-title">{{$p->product_name}}</h5>
                            <p class="card-text">Mô tả: {{$p->content}}</p>
                            <p class="card-text">Giá khởi điểm: {{$p->price}} VNĐ</p>
                            <a href="{{route('detailProduct', ['ProductID'=>$p->product_id])}}" class="btn btn-sm btn-success">
                                <i class="fa fa-info-circle"></i> Thông tin chi tiết
                            </a>
                          </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagination justify-content-center" style="padding-top: 15px">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
