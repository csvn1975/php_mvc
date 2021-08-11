'use strict';

function actionUpdateCart(event) {
    
    event.preventDefault();
    var parentRow = event.target.closest('tr')
    var inputQuantity;

    if (event.target.className === 'cart_quantity_input')
    {
        inputQuantity = event.target
        quantity = inputQuantity.value
    }
    else {
        var increment = (event.target.dataset['up'] === "true")? 1 : -1;
        var inputQuantity = parentRow.querySelector('.cart_quantity_input')
        var quantity = parseInt(inputQuantity.value) 
        quantity = (quantity + increment > 0) ? quantity + increment : 1;
        inputQuantity.value = quantity;
    }
    
    var url = inputQuantity.dataset['url'];
    var product_id = inputQuantity.dataset['id'];
    
    var formData = new FormData();
    formData.append('id', product_id);
    formData.append('quantity', quantity);
     
    fetch( url , {
        method: 'POST', 
        body: formData,
    })
    .then(response => {
        return response.clone().json();
    })

    .then(data => {
        if (data.status == 200) {
            var cartElement = document.getElementById("cart-items-count");
            var totalItemPrice = parentRow.querySelector('.cart_total_price')

            console.log(data.totalItemPrice);
            cartElement.innerText = data.cartItemsCount;
            totalItemPrice.innerText = data.totalItemPrice

            document.querySelector(".sub-total-price").innerText  = data.subtotalPrice;
            document.querySelector(".tax-total-price").innerText  = data.totalTaxPrice;
            document.querySelector(".total-price").innerText  = data.totalPrice; 
        }
        alert(data.message)

    })
    .catch((error) => {
        // alert(data.message)
    });
}


const buttons = document.querySelectorAll('.cart_quantity_down, .cart_quantity_up');
    for (const button of buttons) {
        button.addEventListener('click', actionUpdateCart) 
    }

const quantityInputs = document.querySelectorAll('input[class=cart_quantity_input]');

    for (const quantityInput of quantityInputs) {
        quantityInput.addEventListener('change', actionUpdateCart) 
    }
