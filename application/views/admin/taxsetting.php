<?php 

    include_once('includes/header.php');

?>

<div class="col-md-10 px-4">



	<div class="text-center my-4">

		<h3>Tax Setting</h3>

	</div>

	<!-- add new Tax -->

        <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#addtaxes" type="button">+ Add New Tax </button>

        <br><hr>

    <!-- add new Tax -->

	<div class="table-responsive">

		<table class="table table-hovered table-bordered">

			<thead>

				<tr>

					<td>Sr. No.</td>

					<td>Display Name</td>

					<td>Tax Name</td>

					<td>Tax Amount(Percentage)</td>

					<td>Status</td>

					<td>Default <br><small class="text-danger">If No any tax is assigned to product,<br> Default tax will be applicable</small>	</td>

					<td>Action</td>

				</tr>

			</thead>

			<tbody>

				<?php 

				$i=1;

				foreach ($taxList as $taxesInfo): ?>

					<tr>

						<td><?= $i++ ?></td>

						<td><?= $taxesInfo->name ?></td>

						<td><?= $taxesInfo->taxName ?></td>

						<td><?= $taxesInfo->taxpercent ?>%</td>

						<td>

							<?php if ($taxesInfo->status == 1): ?>

								<span class="badge badge-success">Active</span>

							<?php else: ?>

								<span class="badge badge-danger">Disabled</span>

							<?php endif ?>

							<br>

							<a href="<?= base_url('admin/changestatustax/'.$taxesInfo->id)?>" onclick="return confirm('Are you sure, want to change status?')">Change status</a>

						</td>

						<td>

							<?php if ($taxesInfo->its_default == 1): ?>

								<span class="badge badge-primary">Default</span>

							<?php else: ?>

								<a href="<?= base_url('admin/makeTaxDefault/'.$taxesInfo->id)?>" onclick="return confirm('Are you sure to make it default?')">Make this Default</a>

							<?php endif ?>



						</td>

						<td>

							<a href="<?= base_url('admin/edit_taxesInfo/'.$taxesInfo->id)?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Product"><i class="fa fa-pencil"></i></a>

                            <a href="<?= base_url('admin/deletetaxinfo/'.$taxesInfo->id)?>" onclick="return confirm('Are you sure you want to delete this tax?')"class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Product"><i class="fa fa-trash"></i></a>

                         </td>

					</tr>	

				<?php endforeach ?>

			</tbody>

		</table>

	</div>

</div>





<!-- The Modal -->

<div class="modal" id="addtaxes">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Add New Tax</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>



      <!-- Modal body -->

      <div class="modal-body">

        <form method="post" action="<?= base_url('admin/addnewtaxData')?>">

        	<div class="form-group">

        		<label>Display Name(For Admin)</label>

        		<input type="text" name="dname" placeholder="Enter Tax display name" class="form-control">

        	</div>

        	<div class="form-group">

        		<label>Tax Name</label>

        		<input type="text" name="tname" placeholder="Enter Tax name" class="form-control">

        	</div>

        	<div class="form-group">

        		<label>Tax Percentage</label>

        		<input type="text" name="tpercent" placeholder="Enter Tax Percentage" class="form-control">

        	</div>

        	<button type="submit" class="btn btn-primary">Submit</button>

        </form>

      </div>



      <!-- Modal footer -->

      <div class="modal-footer">

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

      </div>



    </div>

  </div>

</div>

<?php 

    include_once('includes/footer.php');

?>