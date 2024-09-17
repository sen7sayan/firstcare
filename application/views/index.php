<?php 
    include_once("includes/header.php");
    ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>/css/demo1.min.css">
    <?php
    include_once("includes/navbar.php");
 ?>
<style type="text/css">
    .banner{
        cursor: pointer;
    }
    .w-icon-cart{
            margin-right: 7px;
            margin-top: -5px;
        }

</style>    
<script type="text/javascript">
    function slideLink(link) {
        window.location = link;
    }
</script>
       

        <!-- Start of Main-->
        <main class="main">
            <section class="intro-section">
                <div class="swiper-container swiper-theme nav-inner pg-inner swiper-nav-lg animation-slider pg-xxl-hide nav-xxl-show nav-hide"
                    data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 3000,
                        'disableOnInteraction': false
                    }
                }">
                    <div class="swiper-wrapper">
                        <?php foreach ($mainslides as $slides): ?>
                                <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                            style="background-image: url(<?= base_url($slides->imgPath)?>); background-color: #ebeef2;" onclick="slideLink('<?= $slides->link ?>')">
                                    <div class="container">
                                        
                                    </div>
                                    <!-- End of .container -->
                                </div>    
                        <?php endforeach ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <!-- End of .swiper-container -->
            </section>
            <!-- End of .intro-section -->

            <div class="container">
                <div class="swiper-container appear-animate icon-box-wrapper br-sm mt-6 mb-6" data-swiper-options="{
                    'slidesPerView': 1,
                    'loop': true,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '1200': {
                            'slidesPerView': 4
                        }
                    }
                }">
                    <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-shipping">
                                <i class="w-icon-truck"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                                <p class="text-default">For all orders over $99</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-payment">
                                <i class="w-icon-bag"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                                <p class="text-default">We ensure secure payment</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-money">
                            <span class="icon-box-icon icon-money">
                                <i class="w-icon-money"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                                <p class="text-default">Any back within 30 days</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-chat">
                            <span class="icon-box-icon icon-chat">
                                <i class="w-icon-chat"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                                <p class="text-default">Call or email us 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Iocn Box Wrapper -->

                <div class="row category-banner-wrapper appear-animate pt-6 pb-8">
                    <?php 
                        $topBan = $this->db->where("level",1)->get("home_banners")->result();
                     ?>
                     <?php foreach ($topBan as $key => $topers): ?>
                        <?php if ($topers->status == 1): ?>
                            <div class="col-md-6 mb-4">
                                <div class="banner banner-fixed br-xs">
                                    <a href="<?= $topers->imagelink ?>">
                                        <figure>
                                            <img src="<?= base_url($topers->image) ?>" alt="Category Banner"
                                                width="610" height="160" style="background-color: #ecedec;" />
                                        </figure>    
                                    </a>
                                    
                                </div>
                            </div>     
                        <?php endif ?>
                     <?php endforeach ?>
                    
                </div>
                <!-- End of Category Banner Wrapper -->

                <div class="row deals-wrapper appear-animate mb-8">
                    <div class="col-lg-9 mb-4">
                        <div class="single-product h-100 br-sm">
                            <h4 class="title-sm title-underline font-weight-bolder ls-normal">
                                Deals Hot of The Day
                            </h4>
                            <div class="swiper">
                                <div class="swiper-container swiper-theme nav-top swiper-nav-lg" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 1
                                }">
                                    <div class="swiper-wrapper row cols-1 gutter-no">
                                        <?php foreach ($homeoffersPros as $key => $offerproInfo): ?>
                                            <?php 
                                                    $proInfo = $this->Adminmodel->singleProInfo($offerproInfo->product_id);
                                             ?>
                                             <?php if ($proInfo): ?>
                                                 <?php 
                                                $moreImgs = $this->Adminmodel->productExtraImgs($offerproInfo->product_id);
                                             ?>
                                            <div class="swiper-slide">
                                                <div class="product product-single row">
                                                    <div class="col-md-6">
                                                        <div class="product-gallery product-gallery-sticky product-gallery-vertical">
                                                            <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                                                                <div class="swiper-wrapper row cols-1 gutter-no">
                                                                    <div class="swiper-slide">
                                                                        <figure class="product-image">
                                                                            <img src="<?= base_url($offerproInfo->featureImg)?>"
                                                                                data-zoom-image="<?= base_url($offerproInfo->featureImg)?>"
                                                                                alt="<?= $offerproInfo->name ?>" width="800"
                                                                                height="900">
                                                                        </figure>
                                                                    </div>
                                                                    <?php foreach ($moreImgs as $key => $proimgs): ?>
                                                                        <div class="swiper-slide">
                                                                            <figure class="product-image">
                                                                                <img src="<?= base_url($proimgs->imagepath)?>"
                                                                                    data-zoom-image="<?= base_url($proimgs->imagepath)?>"
                                                                                    alt="Product Image" width="800"
                                                                                    height="900">
                                                                            </figure>
                                                                        </div>    
                                                                    <?php endforeach ?>
                                                                    
                                                                </div>
                                                                <button class="swiper-button-next"></button>
                                                                <button class="swiper-button-prev"></button>
                                                                <div class="product-label-group">
                                                                    <label class="product-label label-discount">25%
                                                                        Off</label>
                                                                </div>
                                                            </div>
                                                            <div class="product-thumbs-wrap swiper-container"
                                                                data-swiper-options="{
                                                                'direction': 'vertical',
                                                                'breakpoints': {
                                                                    '0': {
                                                                        'direction': 'horizontal',
                                                                        'slidesPerView': 4
                                                                    },
                                                                    '992': {
                                                                        'direction': 'vertical',
                                                                        'slidesPerView': 'auto'
                                                                    }
                                                                }
                                                            }">
                                                                <div class="product-thumbs swiper-wrapper row cols-lg-1 cols-4 gutter-sm">
                                                                    <div class="product-thumb swiper-slide">
                                                                        <img src="<?= base_url($offerproInfo->featureImg)?>" alt="<?= $offerproInfo->name ?>" width="60" height="68" />
                                                                    </div>
                                                                    <?php foreach ($moreImgs as $key => $proimgs): ?>
                                                                        <div class="product-thumb swiper-slide">
                                                                            <img src="<?= base_url($proimgs->imagepath)?>" alt="<?= $offerproInfo->name ?>" width="60" height="68" />
                                                                        </div>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="product-details scrollable">
                                                            <h2 class="product-title mb-1"><a
                                                                    href="<?= base_url('product-detail/'.$offerproInfo->seo_url )?>"><?= substr($offerproInfo->name,0,88)  ?></a></h2>

                                                            <hr class="product-divider">

                                                            <div class="product-price"><ins class="new-price ls-50">
                                                                <?php if (!empty($offerproInfo->disc_price)): ?>
                                                                    <?= price_symbol($offerproInfo->disc_price) ?>
                                                                <?php else: ?>
                                                                    <?= price_symbol($offerproInfo->price) ?>
                                                                <?php endif ?>
                                                            </ins></div>
                                                            <h4>
                                                                <?php 
                                                                    $date=date_create($offerproInfo->sale_end);
                                                                    $endDate = date_format($date,"Y, m, d");
                                                                    // echo date($offerproInfo->sale_end,"Y-d-m");

                                                                 ?>
                                                            </h4>
                                                            <div class="product-countdown-container flex-wrap">
                                                                <label class="mr-2 text-default">Offer Ends In:</label>
                                                                <div class="product-countdown countdown-compact"
                                                                    data-until="<?= $endDate ?>" data-compact="true">
                                                                     11: 59: 52</div>
                                                            </div>

                                                            <div class="ratings-container">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <a href="#" class="rating-reviews">(3 Reviews)</a>
                                                            </div>
                                                            <?php if ($offerproInfo->proType == 2): ?>
                                                                <!-- <div class="product-form product-variation-form product-size-swatch mb-3">
                                                                    <label class="mb-1">Size:</label>
                                                                    <div
                                                                        class="flex-wrap d-flex align-items-center product-variations">
                                                                        <a href="#" class="size">Extra Large</a>
                                                                        <a href="#" class="size">Large</a>
                                                                        <a href="#" class="size">Medium</a>
                                                                        <a href="#" class="size">Small</a>
                                                                    </div>
                                                                    <a href="#" class="product-variation-clean">Clean All</a>
                                                                </div>

                                                                <div class="product-variation-price">
                                                                    <span></span>
                                                                </div>   -->  
                                                            <?php endif ?>
                                                            <form method="post" onsubmit="return addmetocart(event)">
                                                                <input type="hidden" name="productId" value="<?= $offerproInfo->product_id ?>" >
                                                                   <div class="product-form pt-4">
                                                                        <div class="product-qty-form mb-2 mr-2">
                                                                            <div class="input-group">                 
                                                                                <input class="quantity form-control" type="number"
                                                                                    min="1" max="10000000" name="productQTY">
                                                                                <button type="button" class="quantity-plus w-icon-plus"></button>
                                                                                <button type="button" class="quantity-minus w-icon-minus"></button>
                                                                            </div>
                                                                        </div>
                                                                        <button data-qty_field="true" type="submit" class="btn btn-primary"><i class="w-icon-cart "></i><span>Add to Cart</span> </button>
                                                                    </div>     
                                                            </form>
                                                            <div class="social-links-wrapper mt-1">
                                                                <div class="social-links">
                                                                    <div class="social-icons social-no-color border-thin">
                                                                        <a href="#"
                                                                            class="social-icon social-facebook w-icon-facebook"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-twitter w-icon-twitter"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-youtube fab fa-linkedin-in"></a>
                                                                    </div>
                                                                </div>
                                                                <span class="divider d-xs-show"></span>
                                                                <div class="product-link-wrapper d-flex">
                                                                    <a data-id="<?= $offerproInfo->product_id ?>" href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                                                                    <a href="#"
                                                                        class="btn-product-icon btn-compare btn-icon-left w-icon-compare"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             <?php endif ?>
                                            
                                        <?php endforeach ?>
                                       
                                    </div>
                                    <button class="swiper-button-prev"></button>
                                    <button class="swiper-button-next"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="widget widget-products widget-products-bordered h-100">
                            <div class="widget-body br-sm h-100">
                                <h4 class="title-sm title-underline font-weight-bolder ls-normal mb-2">Newly added </h4>
                                <div class="swiper">
                                    <div class="swiper-container swiper-theme nav-top" data-swiper-options="{
                                        'slidesPerView': 1,
                                        'spaceBetween': 20,
                                        'breakpoints': {
                                            '576': {
                                                'slidesPerView': 2
                                            },
                                            '768': {
                                                'slidesPerView': 3
                                            },
                                            '992': {
                                                'slidesPerView': 1
                                            }
                                        }
                                    }">
                                        <div class="swiper-wrapper row cols-lg-1 cols-md-3">
                                            <?php foreach ($recentPro as $key => $recents): ?>
                                                <?php if ($key % 3 == 0 || $key == 0): ?>
                                                    <div class="swiper-slide product-widget-wrap">    
                                                <?php endif ?>
                                                
                                                    <div class="product product-widget bb-no">
                                                        <figure class="product-media">
                                                            <a href="<?= base_url('product-detail/'.$recents->seo_url )?>">
                                                                <img src="<?= base_url($recents->featureImg)?>"
                                                                    alt="Product" width="105" height="118" />
                                                            </a>
                                                        </figure>
                                                        <div class="product-details">
                                                            <h4 class="product-name">
                                                                <a href="<?= base_url('product-detail/'.$recents->seo_url )?>"><?= substr($recents->name, 0,40) ?></a>
                                                            </h4>
                                                            <div class="ratings-container">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <div class="product-price">
                                                                <ins class="new-price">
                                                                    <?php if (!empty($recents->disc_price)): ?>
                                                                        <?= price_symbol($recents->disc_price) ?>
                                                                        <span class="old-price"><?= price_symbol($recents->price) ?></span>
                                                                    <?php else: ?>
                                                                        <?= price_symbol($recents->price) ?>
                                                                    <?php endif ?>
                                                                </ins>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                <?php if ($key % 3 == 2): ?>
                                                </div>
                                                <?php endif ?>    
                                            <?php endforeach ?>
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Deals Wrapper -->
            </div>

            <section class="category-section top-category bg-grey pt-10 pb-10 appear-animate">
                <div class="container pb-2">
                    <h2 class="title justify-content-center pt-1 ls-normal mb-5">Top Categories Of The Month</h2>
                    <div class="swiper">
                        <div class="swiper-container swiper-theme pg-show" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 5
                                },
                                '992': {
                                    'slidesPerView': 6
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-lg-6 cols-md-5 cols-sm-3 cols-2">
                                <?php 
                                    $topcats = $this->db->where("topCategory",1)->where("status",1)->order_by("id","desc")->get("categories")->result();
                                 ?>
                                 <?php foreach ($topcats as $key => $catInfo): ?>
                                        <div
                                            class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                            <a href="<?= base_url('collection/'.$catInfo->seo_url)?>" class="category-media">
                                                <img src="<?= base_url($catInfo->featureimage)?>" alt="Category"
                                                    width="130" height="130">
                                            </a>
                                            <div class="category-content">
                                                <h4 class="category-name"><?= $catInfo->name?></h4>
                                                <a href="shop-banner-sidebar.html"
                                                    class="btn btn-primary btn-link btn-underline">Shop
                                                    Now</a>
                                            </div>
                                        </div>
                                 <?php endforeach ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of .category-section top-category -->

            <div class="container mt-4">
                <div class="row category-cosmetic-lifestyle appear-animate mb-5">
                    <?php 
                        $midBan = $this->db->where("level",2)->get("home_banners")->result();
                     ?>
                     <?php foreach ($midBan as $key => $topers): ?>
                        <?php if ($topers->status == 1): ?>
                            <div class="col-md-6 mb-4">
                                <div class="banner banner-fixed br-xs">
                                    <a href="<?= $topers->imagelink ?>">
                                        <figure>
                                            <img src="<?= base_url($topers->image) ?>" alt="Category Banner"
                                                width="610" height="160" style="background-color: #ecedec;" />
                                        </figure>    
                                    </a>
                                    
                                </div>
                            </div>  
                        <?php endif ?>
                               
                     <?php endforeach ?>
                </div>
                <!-- End of Category Cosmetic Lifestyle -->
        <?php 
           $homeCatList = $this->db->order_by("preference","asc")->where("status",1)->get("homecats")->result(); 
        ?>
        <?php foreach ($homeCatList as $homecats): ?>
                 <div class="product-wrapper-1 appear-animate mb-5">
                    <div class="title-link-wrapper pb-1 mb-4">
                        <h2 class="title ls-normal mb-0"><?= $homecats->name?></h2>
                        <a href="<?= $homecats->more_pro_link ?>" class="font-size-normal font-weight-bold ls-25 mb-0">More
                            Products<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 mb-4">
                            <a href="<?= $homecats->more_pro_link ?>">
                                <div class="banner h-100 br-sm" style="background-image: url(<?= base_url($homecats->features_img) ?>); 
                                background-color: #ebeced;">
                                </div>    
                            </a>
                            
                        </div>
                        <!-- End of Banner -->
                        <div class="col-lg-9 col-sm-8">
                            <div class="swiper-container swiper-theme" data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }">
                                <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                    
                                        <?php 
                                            $catArr = explode(",", $homecats->cats);
                                            $catList = $this->db->where_in("categories",$catArr)->limit(12)->order_by("id","desc")->get("products")->result();
                                         ?>
                                         <?php foreach ($catList as $key => $proInfo): ?>
                                                <?php if ($key % 2 == 0): ?>
                                                    <div class="swiper-slide product-col">    
                                                <?php endif ?>
                                                <?php 
                                                    $this->load->view("includes/productlistview1",["proInfo"=>$proInfo]);
                                                 ?>
                                                 <?php if ($key % 2 == 1): ?>
                                                    </div>
                                                <?php endif ?>
                                         <?php endforeach ?>
                                   
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach ?>
               
                <!-- End of Product Wrapper 1 -->

                
                <?php 
                    $botBan = $this->db->where("level",3)->get("home_banners")->row();
                 ?>
                 <?php if ($botBan->status == 1): ?>
                    <div class="row category-cosmetic-lifestyle appear-animate mb-5">
                        <div class="col-md-12 mb-4">
                            <div class="banner banner-fixed br-xs">
                                <a href="<?= $botBan->imagelink ?>">
                                    <figure>
                                        <img src="<?= base_url($botBan->image) ?>" alt="Category Banner"
                                            width="610" height="160" style="background-color: #ecedec;" />
                                    </figure>    
                                </a>
                            </div>
                        </div>
                    </div>      
                 <?php endif ?>
               
                <!-- End of Banner Fashion -->

            
                <h2 class="title title-underline mb-4 ls-normal appear-animate">Our Clients</h2>
                <div class="swiper-container swiper-theme brands-wrapper mb-9 appear-animate" data-swiper-options="{
                    'spaceBetween': 0,
                    'slidesPerView': 2,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 3
                        },
                        '768': {
                            'slidesPerView': 4
                        },
                        '992': {
                            'slidesPerView': 5
                        },
                        '1200': {
                            'slidesPerView': 6
                        }
                    }
                }">
                    <div class="swiper-wrapper row gutter-no cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                        <div class="swiper-slide brand-col">
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/1.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/2.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                        </div>
                        <div class="swiper-slide brand-col">
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/3.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/4.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                        </div>
                        <div class="swiper-slide brand-col">
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/5.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/6.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                        </div>
                        <div class="swiper-slide brand-col">
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/7.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/8.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                        </div>
                        <div class="swiper-slide brand-col">
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/9.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/10.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                        </div>
                        <div class="swiper-slide brand-col">
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/11.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                            <figure class="brand-wrapper">
                                <img src="assets/images/demos/demo1/brands/12.png" alt="Brand" width="410"
                                    height="186" />
                            </figure>
                        </div>
                    </div>
                </div>
                <!-- End of Brands Wrapper -->

                <div class="post-wrapper appear-animate mb-4">
                    <div class="title-link-wrapper pb-1 mb-4">
                        <h2 class="title ls-normal mb-0">From Our Blog</h2>
                        <a href="blog-listing.html" class="font-weight-bold font-size-normal">View All Articles</a>
                    </div>
                    <div class="swiper">
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                            'slidesPerView': 1,
                            'spaceBetween': 20,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 2
                                },
                                '768': {
                                    'slidesPerView': 3
                                },
                                '992': {
                                    'slidesPerView': 4
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-1">
                                <div class="swiper-slide post text-center overlay-zoom">
                                    <figure class="post-media br-sm">
                                        <a href="post-single.html">
                                            <img src="assets/images/demos/demo1/blogs/1.jpg" alt="Post" width="280"
                                                height="180" style="background-color: #4b6e91;" />
                                        </a>
                                    </figure>
                                    <div class="post-details">
                                        <div class="post-meta">
                                            by <a href="#" class="post-author">John Doe</a>
                                            - <a href="#" class="post-date mr-0">03.05.2021</a>
                                        </div>
                                        <h4 class="post-title"><a href="post-single.html">Aliquam tincidunt mauris
                                                eurisus</a>
                                        </h4>
                                        <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read
                                            More<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="swiper-slide post text-center overlay-zoom">
                                    <figure class="post-media br-sm">
                                        <a href="post-single.html">
                                            <img src="assets/images/demos/demo1/blogs/2.jpg" alt="Post" width="280"
                                                height="180" style="background-color: #cec9cf;" />
                                        </a>
                                    </figure>
                                    <div class="post-details">
                                        <div class="post-meta">
                                            by <a href="#" class="post-author">John Doe</a>
                                            - <a href="#" class="post-date mr-0">03.05.2021</a>
                                        </div>
                                        <h4 class="post-title"><a href="post-single.html">Cras ornare tristique elit</a>
                                        </h4>
                                        <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read
                                            More<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="swiper-slide post text-center overlay-zoom">
                                    <figure class="post-media br-sm">
                                        <a href="post-single.html">
                                            <img src="assets/images/demos/demo1/blogs/3.jpg" alt="Post" width="280"
                                                height="180" style="background-color: #c9c7bb;" />
                                        </a>
                                    </figure>
                                    <div class="post-details">
                                        <div class="post-meta">
                                            by <a href="#" class="post-author">John Doe</a>
                                            - <a href="#" class="post-date mr-0">03.05.2021</a>
                                        </div>
                                        <h4 class="post-title"><a href="post-single.html">Vivamus vestibulum ntulla nec
                                                ante</a>
                                        </h4>
                                        <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read
                                            More<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="swiper-slide post text-center overlay-zoom">
                                    <figure class="post-media br-sm">
                                        <a href="post-single.html">
                                            <img src="assets/images/demos/demo1/blogs/4.jpg" alt="Post" width="280"
                                                height="180" style="background-color: #d8dce0;" />
                                        </a>
                                    </figure>
                                    <div class="post-details">
                                        <div class="post-meta">
                                            by <a href="#" class="post-author">John Doe</a>
                                            - <a href="#" class="post-date mr-0">03.05.2021</a>
                                        </div>
                                        <h4 class="post-title"><a href="post-single.html">Fusce lacinia arcuet nulla</a>
                                        </h4>
                                        <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read
                                            More<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <!-- Post Wrapper -->

                <h2 class="title title-underline mb-4 ls-normal appear-animate">Your Recent Views</h2>
            
            </div>
            <!--End of Catainer -->
        </main>
        <!-- End of Main -->

<?php 
    include_once("includes/footer.php");
 ?>

