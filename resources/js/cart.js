import axios from "axios";

const addToCartForm = document.forms.namedItem('addToCartForm');

function updateCart(content) {
    document.getElementById('cart').innerHTML = content
}
const addToCart = () => {
    axios.post('/cart/add', new FormData(addToCartForm))
        .then((r) => {updateCart(r.data);})
}
const clearCart = () => {
    axios.post('/cart/clear')
        .then((r) => {updateCart(r.data);})
}
const removeFromCart = (id) => {
    axios.delete('/cart/remove/'+id)
        .then((r) => {updateCart(r.data);})
}


addToCartForm?.addEventListener('submit',  (e)=>{
    e.preventDefault();
    addToCart();
})


document.getElementById('cart').addEventListener('click', (e) => {
    if(e.target.classList.contains('remove')){
        removeFromCart(e.target.closest('tr').dataset.id)
    }
});
document.querySelector('#btnClearCart').addEventListener('click', () => {
    clearCart()
})
