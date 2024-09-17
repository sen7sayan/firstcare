<div class="col-lg-4 col-sm-6">
    <div class="pm-product  ">
      <a href="<?php echo base_url('pet-product/'.$Products->seo_url)?>" class="image"  >
        <img src="<?php echo base_url($Products->featureImg)?>" alt="">
      </a>
      <div class="hover-conents">
        <ul class="product-btns">
          <li><a href="wishlist.html"  ><i class="ion-ios-heart-outline"></i></a></li>
          <li><a href="compare.html"  ><i class="ion-ios-shuffle"></i></a></li>
          <li><a href="#" data-bs-toggle="modal" data-bs-target="#quickModal"  ><i class="ion-ios-search"></i></a></li>
        </ul>
      </div>
      <div class="content">
        <h3 class="font-weight-500"><a href="<?php echo base_url('pet-product/'.$Products->seo_url)?>"><?= $Products->name ?></a></h3>
        <div class="price text-red">
          <?php if ($Products->disc_price !=""): ?>
            <span class="old">₹ <?= $Products->price ?></span>
            <span>₹ <?= $Products->disc_price ?></span>  
          <?php else: ?>
            <span>₹ <?= $Products->price ?></span>  
          <?php endif ?>
          
        </div>
        <div class="btn-block grid-btn">
          <?php if ($Products->proType == 1): ?>
              <button onclick="addMetoCart(<?= $Products->id?>)" class="btn btn-outlined btn-rounded btn-mid">Add to Cart</button>
            <?php else: ?>  
               <a href="<?= base_url('pet-product/'.$Products->seo_url)?>" class="btn btn-outlined btn-rounded btn-mid">View Product</a> 
          <?php endif ?>
          
          
        </div>
        <div class="card-list-content ">
          <div class="rating-widget mt--20">
            <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
            <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
            <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
            <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
            <a href="#" class="single-rating"><i class="far fa-star"></i></a>
          </div>
          <article>
            <h2 class="sr-only d-none">Shop Post Articles</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br> Nam fringilla augue nec est tristique
              auctor.</p>
          </article>
          <div class="btn-block d-flex">
            <?php if ($Products->proType == 1): ?>
              <button onclick="addMetoCart(<?= $Products->id?>)" class="btn btn-outlined btn-rounded btn-mid">Add to Cart</button>
            <?php else: ?>  
               <a href="<?= base_url('pet-product/'.$Products->seo_url)?>" class="btn btn-outlined btn-rounded btn-mid">View Product</a> 
          <?php endif ?>
            <div class="btn-options">
              <a href="wishlist.html"><i class="ion-ios-heart-outline"></i>Add to Wishlist</a>
              <a href="compare.html"><i class="ion-ios-shuffle"></i>Add to Compare</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>