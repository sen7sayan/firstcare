<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Product Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-12 p-2 ">
            <!-- add new Product -->
            <a href="<?= base_url('index.php/admin/add_products')?>" class="btn btn-success btn-sm float-right" >Add New Product</a>
            <br><hr>
            <!-- add new Product -->
            
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Pro. Name</th>
                            <th>Pro code</th>
                            <th>Featured Image</th>
                            <th>price/Dis. Price</th>
                            <th>Stock Status</th>
                            <th>SEO URL</th>
                            <th>Category</th>
                            <th>Pro. Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if (!empty($allpros)) {
                        $i=1; 
                        foreach ($allpros as $products) {
                            ?>
                                <tr>
                                       <td><?= $i++ ?></td> 
                                       <td><a href="<?= base_url('index.php/product/product_detail/'.$products->seo_url)?>" target="_blank"><?= $products->name ?></a></td>
                                       <td>
                                        <p>
                                            <b>HSN</b> : <?= $products->pro_hsn ?>
                                            <br>
                                           <b>Pro Code</b> : <?= $products->productCode ?> 
                                        </p>
                                           
                                       </td>
                                       <td>
                                            <?php 
                                                if (!empty($products->featureImg)) {
                                                    ?>
                                                    <img src="<?= base_url().$products->featureImg ?>" style="width:100px; height:100px">
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "No Image";
                                                }
                                            ?>
                                        </td>
                                       <td>
                                        <span class="font-weight-bold"><?= price_symbol($products->price) ?></span><?php if (($products->disc_price != null) && !empty($products->disc_price)): ?>
                                                / <span class="text-success font-weight-bold"><?= price_symbol($products->disc_price) ?></span>
                                        <?php endif ?><span class="text-success"></span>
                                       </td>
                                       <td>
                                        <?php 
                                            if ($products->stockStatus == 1) {
                                                echo '<span class="badge badge-success">In Stock</span>';
                                            }
                                            else
                                            {
                                                echo '<span class="badge badge-danger">Out Of Stock</span>';
                                            }
                                         ?>
                                            
                                            
                                       </td>
                                       <td><?= $products->seo_url ?></td>
                                       <td><?php 
                                            $cInfo = $this->Homemodel->categoryInfoById($products->categories);
                                            if ($cInfo) {
                                                echo $cInfo->name;
                                            }
                                            else
                                            {
                                                echo '<span class="text-danger">No category found</span>';
                                            }
                                            
                                        ?></td>
                                        
                                       <td>
                                        <?php 
                                            if ($products->status == 1) {
                                                echo '<span class="badge badge-success">Active</span>';
                                            }
                                            else
                                            {
                                                echo '<span class="badge badge-danger">De-Activated</span>';
                                            }
                                         ?>
                                            

                                            <br><br>
                                            <a href="<?= base_url('index.php/admin/changestatusproduct/'.$products->id)?>" onclick="return confirm('Are you sure? you want to change category status!')"class="btn btn-primary btn-sm" data-toggle="tooltip" title="Change Product Status">Change Status</a>
                                       </td>
                                       
                                       <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url('index.php/admin/edit_products/'.$products->id)?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Product"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= base_url('index.php/admin/deleteproduct/'.$products->id)?>" onclick="return confirm('Are you sure you want to delete this Product?')"class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Product"><i class="fa fa-trash"></i></a>
                                                <a href="<?= base_url('index.php/admin/addmoreImages/'.$products->id)?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Add More Product Images"><i class="fa fa-image"></i></a>

                                                <?php if ($products->proType == 2): ?>
                                                        <a href="<?= base_url('index.php/admin/productVariableSetting/'.$products->id)?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Product Variable Setting"><i class="fa fa-product-hunt"></i></a>
                                                <?php endif ?>
                                            </div>
                                       </td>
                                  </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h2>No Product found</h2>";
                            }
                     ?>
                       
                    </tbody>
                </table>
            
        </div>
    </div>
<?php 
    include_once('includes/footer.php');
?>
