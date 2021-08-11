'use strict';
const buttons = document.querySelectorAll('.action_add');
for (const button of buttons) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var url = event.target.dataset['url'];
        var formData = new FormData();
        
        formData.append('id', event.target.dataset['id']);

        fetch( url , {
            method: 'POST', 
            body: formData,
        })
        .then(response => {
            return response.clone().json();
        })
        .then(data => {
            if (data.status == 200) {
                var cart = document.getElementById("cart-items-count");
                cart.innerText = data.cartItemsCount;
            }
            alert(data.message)

        })
        .catch((error) => {
            alert(data.message)
        });
    })
}