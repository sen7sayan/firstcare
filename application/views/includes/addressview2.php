<div class="card-items addresses">
    <span class="add-title"><?= $addres->firstname." ".$addres->lastname ?></span> <br><span class="add-title2">Phone : <?= $addres->phone ?></span>
    <br><span class="add-title2">Email : <?= $addres->email ?></span>
            <br>
    <span class="addr">Address : <?= $addres->address." ".$addres->address2." ".$addres->city." ".$addres->state." ".$addres->pincode." ".$addres->country ?></span>
    <div class="card-btns mt-2">
        <div class="btns">
            <a href="<?= base_url('users/user_addresses/edit-address/'.$addres->id)?>" class="btn btn-link btn-primary btn-simple mr-2">Edit</a>
            <a onclick="return confirm('Are you sure want to delete this address?')" href="<?= base_url('users/delete_user_addresses/'.$addres->id)?>" class="btn btn-secondary btn-underline btn-link lg">Delete</a>
        </div>
    </div>
</div>