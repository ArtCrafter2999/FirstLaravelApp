@extends('templates.categories')

@section('content')
    <style>
        .product-container {
            display: flex;
            align-items: center;
        }
        .product-image {
            flex: 1;
            max-width: 50%;
        }
        .product-details {
            flex: 1;
            padding: 0 20px;
        }
        .product-price {
            font-size: 24px;
            font-weight: bold;
            color: #019d01;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="product-container">
                <div class="product-image">
                    <img src="{{asset($product->image)}}" alt="Product Image" class="img-fluid">
                </div>
                <div class="product-details">
                    <h2>{{$product->title}}</h2>
                    <p><strong>Category:</strong>{{$category->name}}</p>
                    <p class="product-price">${{$product->price}}</p>
                </div>
            </div>
            <div class="btn-group-sm mt-1">
                @foreach($product->tags as $tag)
                    <a class="btn btn-outline-secondary btn-sm" href="/tag/{{$tag->id}}">{{ $tag->name }}</a>
                @endforeach
            </div>
            {!! $product->description !!}
            <form class="mt-4" name="addToCartForm" action="">
                <label>
                    Amount
                    <input class="form-control" type="number" name="quantity" value="1" min="1">
                </label>
                <input type="hidden" name="id" value="{{$product->id}}">
                <button class="btn btn-success">Add to cart</button>
            </form>
            @auth
                @if(Auth::user()->role === 'admin')
                    <div class="btn-group d-flex justify-content-end">
                        <form action="/admin/products/{{$product->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-outline-warning" href="/admin/products/{{$product->id}}/edit">Edit</a>
                            <button class="btn btn-outline-danger">Remove</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
@endsection
