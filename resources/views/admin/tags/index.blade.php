@extends('templates.mainTemplate')

@section('content')
    <h1 class="text-center">Products</h1>
    <!--a href="{{url('admin/products/create')}}" class="btn btn-primary">Add Product</a-->
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Products</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$tag->name}}</td>
                <td>
                    @forelse($tag->products as $product)
                        <a href="/admin/products/{{$product->id}}/edit">{{$product->title}}@if (!$loop->last), @endif</a>
                    @empty
                        <p>--No products--</p>
                    @endforelse
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
