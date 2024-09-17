<?php
  if (isset($imageSetboxFlag)) {
     $imageboxId = $imageSetboxFlag;
   } 
   else{
      $imageboxId = "modalboximage";
   }
    
 ?>
<button type="button" class="btn btn-info addimageModal" data-inputid="<?= $imageboxId ?>"  data-toggle="modal" data-target="#imagegettermodal"><i class="fa fa-image mr-2"></i> Choose Image</button>
                                <!-- Image Popup -->

<?php if (isset($imgurl)): ?>
  <input class="form-control form-control-sm" value="<?= $imgurl ?>" name="modalboximage" id="<?= $imageboxId ?>" type="hidden" >
  <img src="<?= base_url($imgurl)?>" id="<?= $imageboxId ?>Src" style="width: 70px;height: 70px;">
<?php else: ?>
  <input class="form-control form-control-sm" value="uploads/dummy/dummy.jpg" name="modalboximage" id="<?= $imageboxId ?>" type="hidden" >
  <img src="<?= base_url('uploads/dummy/dummy.jpg')?>" id="<?= $imageboxId ?>Src" style="width: 70px;height: 70px;">
<?php endif ?>
