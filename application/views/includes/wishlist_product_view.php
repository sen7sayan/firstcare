<tr>
    <td class="product-thumbnail">
        <div class="p-relative">
            <a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>">
                <figure>
                    <img src="<?= base_url($proInfo->featureImg)?>" alt="product" width="300"
                        height="338">
                </figure>
            </a>
            <button data-wishid="<?= $wishId ?>" type="button" class="btn btn-close rm-wish-item"><i class="fas fa-times"></i></button>
        </div>
    </td>
    <td class="product-name">
        <a href="product-default.html">
            <?= $proInfo->name ?>
        </a>
    </td>
    <td class="product-price">
        <ins class="new-price">
            <?php 
                if ($proInfo->disc_price) {
                    echo price_symbol($proInfo->disc_price);
                }
                else{
                    echo price_symbol($proInfo->price);
                }
                
             ?>
        </ins>
    </td>
    <td class="product-stock-status">
        <?php if ($proInfo->stockStatus == 1): ?>
            <span class="wishlist-in-stock">In Stock</span>
            <?php else: ?>
            <span class="wishlist-in-stock">Out Of Stock</span>    
        <?php endif ?>
        
    </td>
    <td class="wishlist-action">
        <div class="d-lg-flex">
            <a href="#" data-proid ="<?= $proInfo->id ?>" class="btn btn-quickview btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0">Quick
                View</a>
            <a data-id="<?= $proInfo->id ?>" href="#" class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                cart</a>
        </div>
    </td>
</tr>