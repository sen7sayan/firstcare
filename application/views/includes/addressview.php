<div class="col-md-6 p-3 addresses" data-statename="<?= $addres->state ?>">
    <div class="card-items">
        <div class="form-check">
          <label class="form-check-label">
            <?php 
                if ($addres->last_used == 1) {
                    $ched = "checked";
                }
                else{
                    $ched = "";
                }
             ?>
            <input <?= $ched ?> type="radio" class="form-check-input" name="optradio" value="<?= $addres->id ?>"><span class="ml-2 add-title"><?= $addres->firstname." ".$addres->lastname ?></span> <br><span class="add-title2">Phone : <?= $addres->phone ?></span>
            <br><span class="add-title2">Email : <?= $addres->email ?></span>
            <br>
            <span class="addr">Address : <?= $addres->address." ".$addres->address2." ".$addres->city." ".$addres->state." ".$addres->pincode." ".$addres->country ?></span>
          </label>
        </div>
    </div>
</div>