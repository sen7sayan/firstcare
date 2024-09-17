<div class="row gutter-lg">
    <div class="col-md-6 mb-4 mb-md-0">
        <div class="product-gallery product-gallery-sticky">
            <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                <div class="swiper-wrapper row cols-1 gutter-no">
                    <div class="swiper-slide">
                        <figure class="product-image">
                            <img src="<?= base_url($proInfo->featureImg) ?>"
                                data-zoom-image="<?= base_url($proInfo->featureImg) ?>"
                                alt="<?= $proInfo->name ?>" width="800" height="900">
                        </figure>
                    </div>
                    <?php foreach ($moreImgs as $mImages): ?>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="<?= base_url($mImages->imagepath) ?>"
                                    data-zoom-image="<?= base_url($mImages->imagepath) ?>"
                                    alt="<?= $mImages->alt ?>" width="488" height="549">
                            </figure>
                        </div>    
                    <?php endforeach ?>
                    
                </div>
                <button class="swiper-button-next"></button>
                <button class="swiper-button-prev"></button>
            </div>
            <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                'navigation': {
                    'nextEl': '.swiper-button-next',
                    'prevEl': '.swiper-button-prev'
                }
            }">
                <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                    <div class="product-thumb swiper-slide">
                        <img src="<?= base_url($proInfo->featureImg) ?>"
                            alt="Product Thumb" width="800" height="900">
                    </div>
                    <?php foreach ($moreImgs as $mImages): ?>
                        <div class="product-thumb swiper-slide">
                            <img src="<?= base_url($mImages->imagepath) ?>"
                                alt="<?= $mImages->alt ?>" width="800" height="900">
                        </div>
                    <?php endforeach ?>
                </div>
                <button class="swiper-button-next"></button>
                <button class="swiper-button-prev"></button>
            </div>
        </div>
    </div>
    <div class="col-md-6 overflow-hidden p-relative">
        <div class="product-details scrollable pl-0">
            <h2 class="product-title"><?= $proInfo->name ?></h2>
            <div class="product-bm-wrapper">
                <div class="product-meta">
                    <div class="product-categories">
                        Category:
                        <span class="product-category"><a href="<?= base_url('collection/'.$catInfo->seo_url)?>"><?= $catInfo->name ?></a></span>
                    </div>
                    <div class="product-sku">
                        Product Code: <span><?= $proInfo->pro_hsn ?></span>
                    </div>
                </div>
            </div>

            <hr class="product-divider">

            <div class="product-price">
                <ins class="new-price">
                    <?php if (!empty($proInfo->disc_price)): ?>
                        <?= price_symbol($proInfo->disc_price) ?>
                        <span class="old-price"><?= price_symbol($proInfo->price) ?></span>
                    <?php else: ?>
                        <?= price_symbol($proInfo->price) ?>
                    <?php endif ?>
                </ins>
            </div>

            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width: 80%;"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="#" class="rating-reviews">(3 Reviews)</a>
            </div>

            <div class="product-short-desc">
                <ul class="list-type-check list-style-none">
                    <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                    <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                    <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                </ul>
            </div>

            <hr class="product-divider">

            <div class="product-variation-price">
                <span></span>
            </div>
            <form method="post" onsubmit="return addmetocart(event)">
                <input type="hidden" name="productId" value="<?= $proInfo->id ?>" >
                    <div class="product-form">
                        <div class="product-qty-form">
                            <input class="form-control" type="number" min="1" max="10000000" name="productQTY" value="1">
                            
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="w-icon-cart"></i>
                            <span>Add to Cart</span>
                        </button>
                    </div>
            </form>

            <div class="social-links-wrapper">
                <div class="social-links">
                    <div class="social-icons social-no-color border-thin">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                        <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                        <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                    </div>
                </div>
                <span class="divider d-xs-show"></span>
                <div class="product-link-wrapper d-flex">
                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                    <a href="#"
                        class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                </div>
            </div>
        </div>
    </div>
</div>