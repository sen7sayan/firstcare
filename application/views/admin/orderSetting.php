<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">
	<div class="table-responsive">
		<table class="table table-hovered table-bordered">
			<thead>
				<tr>
					<td>Sr. No.</td>
					<td>UUId</td>
					<td>User Name</td>
					<td>Order Amount<br>
						(<small class="text-danger">Without Tax</small>)
					</td>
					<td>Total Items</td>
					<td>Contact Details</td>
					<td>Order Date/Time</td>
					<td>Order Details</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach ($allOdrs as $orders): ?>
					<tr>
						<td><?= $i++ ?></td>
						<td><?= $orders->userid ?></td>
						<td><?= $orders->user_name ?></td>
						<td>₹ <?= $orders->amount ?></td>
						<td><?= $orders->totalItems ?></td>
						<td>
							<?php
								echo $orders->userPhone;
								echo "<br>".$orders->email;
							  ?>
						</td>
						<td><?= $orders->created_at ?></td>
						<td>
							<a href="<?= base_url('orders/billing/'.$orders->id)?>" class="btn btn-info btn-sm">View Bill/Order</a>
						 </td>
					</tr>	
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php 
    include_once('includes/footer.php');
?>