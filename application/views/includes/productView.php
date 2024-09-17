
<div class="list-product-slide">
    <div class="text-center">
        <a href="<?= base_url('product-detail/'.$products->seo_url)?>">
            <img src="<?= base_url($products->featureImg)?>" class="img-fluid">
            <h3 class="list-product-title"><?= substr($products->name, 0,50)?></h3>
        </a>
        <a href="<?= base_url('product-detail/this-is-book-name')?>" class="list-text-auther mt-n5"><?= $catInfo->name ?></a>
        <div class="text-center mt-3">
            <?php if ($products->disc_price < $products->price && !empty($products->disc_price) && is_numeric($products->disc_price)): ?>
                    <div class="list-price-box">
                        <div class="pr-1"><p class="list-product-price">₹ <?= $products->disc_price ?></p></div>
                        <div class="pr-1"><p class="list-product-price list-product-price-cross">₹ <?= $products->price ?></p></div>
                        <div><p class="list-product-price text-success">(<?php echo round((($products->price - $products->disc_price) / $products->price)*100) ?>% Off)</p></div>
                    </div>    
            <?php else: ?>
                <?php if (is_numeric($products->price)): ?>
                    <p class="list-product-price text-center">₹ <?= $products->price ?></p>
                <?php endif ?>
            <?php endif ?>
            
            
        </div>
        <div class="d-flex px-3">
            <div class="mr-2">
                <button data-id="<?= $products->id ?>" class="btn btn-sm btn-outline-dark addtoCart">Add to cart</button>
            </div>
            <div class="ml-auto">
                <?php if (isset($wishlist) && $wishlist == true): ?>
                    <a href="javascript:void(0)" data-wishid="<?= $wishId ?>" class="list-add-wishlist rm-wish-item "><i class="fa fa-trash text-secondary"></i></a>
                <?php else: ?>
                    <a href="javascript:void(0)" data-id="<?= $products->id ?>" class="list-add-wishlist addtoWishlist"><i class="fa fa-heart-o mr-4"></i></a>    
                <?php endif ?>
            </div>
        </div>
    </div>
</div> 




