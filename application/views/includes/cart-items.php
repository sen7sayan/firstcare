<input type="hidden" name="proids[]" value="<?= $cartItem["rowid"] ?>">
<input type="hidden" name="poIds[]" value="<?= $cartItem["id"] ?>">
<input type="hidden" name="taxes[]" value="<?= $cartItem["options"]["tax"] ?>">
<input type="hidden" name="mainImg[]" value="<?= $cartItem["options"]["mainImg"] ?>">
<input type="hidden" name="seo_url[]" value="<?= $cartItem["options"]["seo_url"] ?>">
<tr>
    <td class="product-thumbnail">
        <div class="p-relative">
            <a href="<?= base_url('product-detail/'.$cartItem["options"]["seo_url"])?>">
                <figure>
                    <img src="<?= base_url($cartItem["options"]["mainImg"])?>" alt="product"
                        width="300" height="338">
                </figure>
            </a>
            <button data-rowid="<?= $cartItem['rowid']?>" type="button" class="btn btn-close rm-cart-item"><i
                    class="fas fa-times"></i></button>
        </div>

    </td>
    <td class="product-name">
        <a href="<?= base_url('product-detail/'.$cartItem["options"]["seo_url"])?>">
            <?= $cartItem["name"] ?>
        </a>
    </td>
    <td class="product-price"><span class="amount"><?= price_symbol($cartItem["price"])?></span></td>
    <td class="product-quantity">
        <div class="input-group">
            <input value="<?= $cartItem["qty"] ?>" name="quantity[]" class="form-control" type="number" min="1" max="100000" >
            <button type="button" class="w-icon-plus"></button>
            <button type="button" class="w-icon-minus"></button>
        </div>
    </td>
    <td class="product-subtotal">
        <span class="amount"><?= price_symbol($cartItem["subtotal"]) ?></span>
    </td>
</tr>
<?php 
    if ($cartItem["options"]["giftwap"] == 1) {
        $giftCheck = "checked";
    }
    else{
        $giftCheck = "";
    }
 ?>
 <input type='hidden' value="<?= $giftCheck ?>" name="giftWrap[<?= $iteration ?>]">
 
