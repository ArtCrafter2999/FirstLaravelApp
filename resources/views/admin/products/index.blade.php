@extends('templates.mainTemplate')

@section('content')
    <h1 class="text-center">Products</h1>
    <a href="{{url('admin/products/create')}}" class="btn btn-primary">Add Product</a>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Category</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$loop->index+1+($products->currentPage()-1) * $products->perPage()}}</td>
                <td><img src="{{asset($product->image)}}" alt="product image" style="width: 70px"></td>
                <td>{{$product->title}}</td>
                <td>{{$product->price}}</td>
                <td>{{isset($product->category)? $product->category->name : "--not specified--"}}</td>
                <td class="btn-group">
                    <form action="/admin/products/{{$product->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-warning" href="/admin/products/{{$product->id}}/edit">Edit</a>
                        <button class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}
@endsection
