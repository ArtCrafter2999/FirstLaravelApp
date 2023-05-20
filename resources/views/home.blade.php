@extends('templates.categories')

@section('content')
    <h1 class="text-center">Newest products</h1>
    <div class="row mt-5">
        @forelse($products as $product)
            <a class="card btn btn-outline-secondary m-1" href="{{url('/product/'.$product->slug)}}" style="width: 18rem;">
                <img class="card-img-top" src="{{asset($product->image)}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{{(mb_strlen($product->description) > 150) ? mb_substr($product->description, 0, 150) . '...' : $product->description}}</p>
                    <h4>{{$product->price}}</h4>
                </div>
            </a>
        @empty
            <p>No products</p>
        @endforelse
    </div>
@endsection
