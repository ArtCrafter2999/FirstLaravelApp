@if(session('cart'))

    <table class="table">
        @foreach(session('cart') as $product)
            <tr data-id="{{$product['id']}}">
                <td><img src="{{asset($product['image'])}}" alt="" style="width: 100px"></td>
                <td>{{$product['title']}}</td>
                <td>{{$product['quantity']}}</td>
                <td>{{$product['price']}}</td>
                <td><button class="btn btn-danger remove">&#10006</button></td>
            </tr>
        @endforeach
    </table>

@else
    <h4>Your cart is empty</h4>
@endif
