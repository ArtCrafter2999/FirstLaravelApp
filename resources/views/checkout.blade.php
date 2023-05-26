@extends('templates.mainTemplate')

@section('content')
    <table class="table">
        @foreach($cart as $product)
            <tr data-id="{{$product['id']}}">
                <td><img src="{{asset($product['image'])}}" alt="" style="width: 100px"></td>
                <td>{{$product['title']}}</td>
                <td>{{$product['quantity']}}</td>
                <td>{{$product['price']}}</td>
            </tr>
        @endforeach
    </table>
    <div class="row justify-content-end">
        <h4>{{session('totalSum')}} UAH</h4>
        {!! $html !!}
    </div>

@endsection
