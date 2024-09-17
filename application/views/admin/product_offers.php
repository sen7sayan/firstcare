<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Home Offer Products</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-12 p-2 ">
            <!-- add new slide -->
            <button class="btn btn-success btn-sm float-right" data-toggle="collapse" data-target="#addoffers">Add New Product in Offer</button>
            <div id="addoffers" class="collapse">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div class="card-head"><h4>Add New offer on home page</h4></div>
                            <div class="card-body p-3">
                                <form action="<?= base_url('admin/add_offers_data')?>" method="post">
                                    <div class="row">
                                        <div class="col-md-12 p-1">
                                            <div class="form-group">
                                                <label for="catname">Offer Name</label>
                                                <input type="text" name="offerName" id="catname" class="form-control" required placeholder="Enter Offer Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-1">
                                            <div class="form-group">
                                                <label for="parentcat">Choose a Product</label>
                                                <select name="productId"  class="parentCat form-control">
                                                    <?php 
                                                        if(!empty($allproducts)) {
                                                            foreach ($allproducts as $pros) {
                                                                ?>
                                                                   <option value="<?= $pros->id ?>"><?= $pros->name ?></option> 
                                                                <?php
                                                            }
                                                        }
                                                     ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-2">
                                            <div class="form-group">
                                                <label for="catname">Offer Start date</label>
                                                <input type="date" name="startdate" id="catname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-2">
                                            <div class="form-group">
                                                <label for="catname">Offer End date</label>
                                                <input type="date" name="enddate" id="catname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-2">

                                            <button type="submit" class="btn btn-primary mt-5">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <br><hr>
            <!-- add new slide -->
            <div class="table-responsive">
                <small class="text-danger">We rocommend you please <b>Active</b> at most 3-4 prodducts at a time for offers</small>
                <table class="table table-hovered table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Offer Name</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Sale <br>Start Data</th>
                            <th>Sale <br>ends Data</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($alloffers as $key => $offerInfo): ?>
                            <?php 
                                $proInfo = $this->db->select("id,name,featureImg")->where("id",$offerInfo->product_id)->get("products")->row();
                             ?>
                             <?php if ($proInfo): ?>
                                 <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $offerInfo->name ?></td>
                                    <td>
                                         <img src="<?= base_url($proInfo->featureImg)?>" style="width: 100px;height: auto;">
                                    </td>
                                    <td width="200"><?= $proInfo->name ?></td>
                                    <td><?= $offerInfo->sale_start ?></td>
                                    <td><?= $offerInfo->sale_end ?></td>
                                    <td>
                                        <?php if ($offerInfo->status == 1): ?>
                                            <span class="badge badge-success">Visible</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Hidden</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm editbtn" data-toggle="modal" data-target="#editoffer" title="Edit Product" data-offerinfo="<?= $offerInfo->id ?>"><i class="fa fa-pencil mr-2"></i> Edit</button>
                                            <a href="<?= base_url('admin/deleteoffer/'.$offerInfo->id)?>" onclick="return confirm('Are you sure you want to delete this Offer?')" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Product"><i class="fa fa-trash"></i></a>
                                            <a href="<?= base_url('admin/changestatusoffer/'.$offerInfo->id)?>" onclick="return confirm('Are you sure you want to change visibility status of this Offer?')" class="btn btn-info btn-sm" data-toggle="tooltip" title="Change Visibility"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                             <?php endif ?>
                            
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- The Modal -->
<div class="modal" id="editoffer">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Offer</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- edit Modal body -->
      <div class="modal-body">
        <div class="p-3">
            <form action="<?= base_url('admin/edit_offers_data')?>" method="post">
                <input type="hidden" name="offerId" id="offerId">
                <div class="row">
                    <div class="col-md-12 p-1">
                        <div class="form-group">
                            <label for="offerName">Offer Name</label>
                            <input type="text" name="offerName" id="offerName" class="form-control" required placeholder="Enter Offer Name" >
                        </div>
                    </div>
                    <div class="col-md-12 p-1">
                        <div class="form-group">
                            <label for="productId">Choose a Product</label>
                            <select name="productId" id="productId" class="parentCat form-control">
                                <?php 
                                    if(!empty($allproducts)) {
                                        foreach ($allproducts as $pros) {
                                            ?>
                                               <option value="<?= $pros->id ?>"><?= $pros->name ?></option> 
                                            <?php
                                        }
                                    }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 px-2">
                        <div class="form-group">
                            <label for="startdate">Offer Start date</label>
                            <input type="date" name="startdate" id="startdate" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4 px-2">
                        <div class="form-group">
                            <label for="enddate">Offer End date</label>
                            <input type="date" name="enddate" id="enddate" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4 px-2">

                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.parentCat').select2({
            placeholder: 'Select Product',
            width: 'resolve',
            allowClear:true,
            dropdownAutoWidth:true,
            
        });

        $(".editbtn").on("click",function () {
            var offerId = $(this).data("offerinfo");
             axios.get("<?= base_url('admin/homeofferInfo/')?>"+offerId).then(function (response) {
             console.log(response.data)
             $("#offerName").val(response.data.offName)
             $("#startdate").val(response.data.offstart)
             $("#enddate").val(response.data.offend)
             $("#productId").val(response.data.offproid).change();
             $("#offerId").val(offerId);
          })
          .catch((error) => console.log(error));
        })


    });
</script>
<?php 
    include_once('includes/footer.php');
?>