<div class="modal-dialog" id="cart">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">🛒 Your cart</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @include('_mini-cart')
        </div>
        <div class="modal-footer">
            <h4>{{session('totalSum')}} UAH</h4>
            <button type="button" class="btn btn-secondary @if(session('totalSum') == 0)disabled @endif" id="btnClearCart">Clear</button>
            <a href="/cart/checkout" class="btn btn-primary @if(session('totalSum') == 0)disabled @endif">Checkout</a>
        </div>
    </div>
</div>
