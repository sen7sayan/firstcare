<div class="product-wrap product text-center">
    <figure class="product-media">
        <a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>">
            <img src="<?= base_url($proInfo->featureImg)?>" alt="Product"
                width="216" height="243" />
        </a>
        <div class="product-action-vertical">
            <a href="#" data-id="<?= $proInfo->id ?>" class="btn-product-icon btn-cart w-icon-cart"
                title="Add to cart"></a>
            <a data-id="<?= $proInfo->id ?>" href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                title="Add to wishlist"></a>
            <a href="#" data-proid ="<?= $proInfo->id ?>" class="btn-product-icon btn-quickview w-icon-search"
                title="Quickview"></a>
            <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                title="Add to Compare"></a>
        </div>
    </figure>
    <div class="product-details">
        <h4 class="product-name"><a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>"><?= $proInfo->name ?></a>
        </h4>
        <div class="ratings-container">
            <div class="ratings-full">
                <span class="ratings" style="width: 60%;"></span>
                <span class="tooltiptext tooltip-top"></span>
            </div>
            <a href="<?= base_url('product-detail/'.$proInfo->seo_url )?>" class="rating-reviews">(3
                reviews)</a>
        </div>
        <div class="product-price">
        	<?php if (!empty($proInfo->disc_price)): ?>
        		<ins class="new-price">₹ <?= $proInfo->disc_price ?></ins><del
                class="old-price">₹ <?= $proInfo->price ?></del>
            <?php else: ?>	
            	<ins class="new-price">₹ <?= $proInfo->price ?></ins>
        	<?php endif ?>
            
        </div>
    </div>
</div>