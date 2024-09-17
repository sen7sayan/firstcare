 <!-- Cart items -->
        <input type="hidden" name="proids[]" value="<?= $cartItem["rowid"] ?>">
        <input type="hidden" name="poIds[]" value="<?= $proinfo->id ?>">
        <input type="hidden" name="taxes[]" value="<?= $cartItem["options"]["tax"] ?>">
        <div class="item-list">
            <a href="javascript:void(0)" data-id="<?= $proinfo->id ?>" class="addtoWishlist add-wishlist"><i class="fa fa-heart-o mr-2"></i><span >Save for later</span></a>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div class="cart-image">
                                <img src="<?= base_url($proinfo->featureImg) ?>" class="img-fluid mb-3"><br>
                            </div>
                        </td>
                        <td class="pl-3">
                            <div class="cart-detail">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="">
                                            <h4><?= $proinfo->name?></h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex cart-price">
                                            <?php if ($proinfo->disc_price < $proinfo->price && !empty($proinfo->disc_price) && is_numeric($proinfo->disc_price)):
                                                $showPrice = $proinfo->disc_price;   
                                                $crossPrice = $proinfo->price;
                                            ?>
                                                <h3 class="product-price mr-2">₹<?= $showPrice ?></h3>
                                                <h3 class="product-price list-product-price-cross">₹ <?= $crossPrice ?></h3>
                                                <h5 class="product-price text-success">(<?php echo round((($crossPrice - $showPrice) / $crossPrice)*100) ?>% Off)</h5>
                                            <?php else: 
                                                   $showPrice = $proinfo->price;    
                                                ?>
                                                <h3 class="product-price mr-2">₹<?= $showPrice ?></h3>
                                            <?php endif ?>
                                            
                                        </div>
                                        <!-- qty btn -->
                                        <div class="qty-area">
                                            <div class="quantity-item d-flex text-center">
                                                <div class="quantity-item d-flex align-items-center">
                                                    <input type="number" min="1" class="qtyInput" value="<?= $cartItem["qty"] ?>" name="quantity[]"> 
                                                </div>
                                            </div>
                                        </div>
                                        <!-- qty btn -->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex price-total">
                                            <div>
                                                <!-- <h3 class="product-price mr-2"><?= $cartItem["qty"] ?> X ₹<?= $showPrice ?></h3> -->
                                                <h3 class="product-price mr-2">₹<?= $cartItem["subtotal"] ?> </h3>
                                                
                                                <?php if ($cartItem["options"]["taxType"] == "included"): ?>
                                                    <p class="text-gray">(Inclusive All Taxes)</p>    
                                                <?php else: ?>    
                                                    <p class="text-secondary">
                                                        <?php 
                                                            $totalTaxPer = 0;
                                                            
                                                             $taxslab = $proinfo->taxSlab;
                                                             $taxArr = explode(",", $taxslab);
                                                             for ($k=0; $k < count($taxArr) ; $k++) { 
                                                                $taxInfo= $this->db->where("id",$taxArr[$k])->get("taxes")->row();
                                                                $totalTaxPer = $totalTaxPer + $taxInfo->taxpercent;
                                                                
                                                             }
                                                             echo $totalTaxPer;
                                                            
                                                         ?>%(Tax)
                                                    </p>
                                                <?php endif ?>
                                                <?php if ($singProsave != 0 && $singProsave > 0): ?>
                                                    <p class="text-success font-weight-bold">You saved : ₹<?= $singProsave ?></p>     
                                                <?php endif ?>
                                                
                                            </div>
                                            
                                            <a href="javascript:void(0)" data-rowid="<?= $cartItem['rowid']?>" class="rm-cart-item ml-auto"> <i class="fa fa-trash text-secondary"></i></a>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php 
                if ($cartItem["options"]["giftwap"] == 1) {
                    $giftCheck = "checked";
                }
                else{
                    $giftCheck = "";
                }
             ?>
             <input type='hidden' value="0" name="giftWrap[<?= $iteration ?>]">
            <label><input type="checkbox" <?= $giftCheck ?> name="giftWrap[<?= $iteration ?>]" value="1" class="cb1 mr-2"> <i class="fa fa-gift mr-2"></i>  Gift wrap </label>
            
        </div>
        <!-- Cart items -->