<div class="product product-cart">
    <div class="product-detail">
        <a href="<?= base_url('product-detail/'.$cartItem["options"]["seo_url"])?>" class="product-name"><?= $cartItem["name"] ?></a>
        
        <div class="price-box">
            <span class="product-quantity"><?= $cartItem["qty"] ?></span>
            <span class="product-price"><?= price_symbol($cartItem["price"]) ?></span>
        </div>
    </div>
    <figure class="product-media">
        <a href="<?= base_url('product-detail/'.$cartItem["options"]["seo_url"])?>">
            <img src="<?= base_url($cartItem["options"]["mainImg"]) ?>" alt="product" height="84" width="94" />
        </a>
    </figure>
    <!-- <button class="btn btn-link btn-close" aria-label="button">
        <i class="fas fa-times"></i>
    </button> -->
</div> 