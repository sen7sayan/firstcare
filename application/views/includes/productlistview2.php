<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>">
                <img src="<?= base_url($proInfo->featureImg)?>" alt="Product" width="300"
                    height="338" />
            </a>
            <div class="product-action-horizontal">
                <a href="#" data-id="<?= $proInfo->id ?>" class="btn-product-icon btn-cart w-icon-cart"
                    title="Add to cart"></a>
                <a href="#" data-id="<?= $proInfo->id ?>" class="btn-product-icon btn-wishlist w-icon-heart"
                    title="Wishlist"></a>
                <a href="#"  class="btn-product-icon btn-compare w-icon-compare"
                    title="Compare"></a>
                <a href="#" data-proid ="<?= $proInfo->id ?>" class="btn-product-icon btn-quickview w-icon-search"
                    title="Quick View"></a>
            </div>
        </figure>
        <div class="product-details">
            <div class="product-cat">
                <a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>"><?= $catname ?></a>
            </div>
            <h3 class="product-name">
                <a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>"><?= $proInfo->name ?></a>
            </h3>
            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width: 100%;"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>" class="rating-reviews">(3 reviews)</a>
            </div>
            <div class="product-pa-wrapper">
                <?php if (!empty($proInfo->disc_price)): ?>
                    <div class="product-price">
                        ₹ <?= $proInfo->disc_price ?> <del class="old-price">₹ <?= $proInfo->price ?></del>
                    </div>
                    
                <?php else: ?>  
                    <div class="product-price">
                        ₹ <?= $proInfo->price ?>
                    </div>
                    
                <?php endif ?>
                
            </div>
        </div>
    </div>
</div>