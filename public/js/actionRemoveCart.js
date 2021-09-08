"use strict";

function actionRemove(event) {
    event.preventDefault();

    var parentRow = event.target.closest("tr");
    var linkElement = parentRow.querySelector(".cart_quantity_delete");

    var url = linkElement.dataset["url"];
    var product_id = linkElement.dataset["id"];

    var formData = new FormData();
    formData.append("id", product_id);

    fetch(url, {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            return response.clone().json();
        })

        .then((data) => {
            if (data.status == 200) {
                var cartElement = document.getElementById("cart-items-count");
                parentRow.remove();
                cartElement.innerText = data.cartItemsCount;

                document.querySelector(".sub-total-price").innerText =
                    data.subtotalPrice;
                document.querySelector(".tax-total-price").innerText =
                    data.totalTaxPrice;
                document.querySelector(".total-price").innerText =
                    data.totalPrice;
            }

            alert(data.message);
        })
        .catch((error) => {
            alert(data.message);
        });
}

const deleteCheckboxes = document.querySelectorAll(".cart_delete");
for (const deleteCheckbox of deleteCheckboxes) {
    deleteCheckbox.addEventListener("click", actionRemove);
}
