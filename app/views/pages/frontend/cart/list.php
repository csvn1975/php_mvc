<section id="cart_items">
    <h1 class="text-center mt-5">Cart List</h1>
    <!-- table carts -->
    <div class="table-responsive cart_info">
        <!-- table cart items -->
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <!-- table content -->
            <tbody>
                <?php foreach ($cart->items as $productId => $cartItem) : ?>
                    <tr>
                        <td class="cart_product">
                            <img src="<?= UPLOAD_FOLDER . $cartItem['thumbnail'] ?>" alt="">
                        </td>
                        <td class="cart_description">
                            <h4><?= $cartItem['name'] ?> </h4>
                        </td>
                        <td class="cart_price">
                            <p><?= gerCurrency($cartItem['price']) ?> </p>
                        </td>

                        <td class="cart_quantity">
                            <div class="cart_quantity_button" data-="">
                                <a class="cart_quantity_up" data-up="true" href=""> + </a>
                                <input class="cart_quantity_input" data-id="<?= $productId ?>" data-url="/cart/updateCart" type="number" name="quantity" min="1" style="width:30" value=<?= $cartItem['quantity'] ?> autocomplete="off" size="2">
                                <a class="cart_quantity_down" data-up="false" href=""> - </a>
                            </div>

                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price"> <?= gerCurrency($cartItem['totalPrice']) ?> </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" data-url="/cart/removeCart" data-id="<?= $productId ?>"
                            href="#"><i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tbody>
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td> <span class="sub-total-price"><?=gerCurrency($cart->subtotalPrice) ?> </span> </td>
                                </tr>
                                <tr>
                                    <td>Exo Tax (19%)</td>
                                    <td><span class="tax-total-price"><?=gerCurrency($cart->totalTaxPrice) ?></span></td>
                                </tr>
                                <tr>
                                    <td>Shipping Cost</td>
                                    <td><span class="shipping-cost">Free</span></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span class="total-price"><?=gerCurrency($cart->totalPrice) ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- table cart items -->
    </div>
</section>

<script src="/public/js/actionUpdateCart.js"> </script>
<script src="/public/js/actionRemoveCart.js"> </script>