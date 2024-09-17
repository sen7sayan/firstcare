<?php 
    include_once('includes/header.php');
?>
<div class="col-md-10 px-4">

	<div class="text-center my-4">
		<h3>Edit Tax Setting <?= $taxtinfo->name ?></h3>
	</div>
	<!-- add new Tax -->
        <a href="<?= base_url('admin/taxSetting')?>" class="btn btn-success btn-sm float-right">= Tax List</a>
        <br><hr>
        <div class="row">
        	<div class="col-md-3"></div>
        	<div class="col-md-6">
        			<div class="card">
        				<div class="card-body p-3">
        						<form method="post" action="<?= base_url('admin/edit_taxesInfoData')?>">
						        	<div class="form-group">
						        		<label>Display Name(For Admin)</label>
						        		<input type="hidden" name="taxId" value="<?= $taxtinfo->id ?>">
						        		<input type="text" name="dname" placeholder="Enter Tax display name" class="form-control" value="<?= $taxtinfo->name ?>" >
						        	</div>
						        	<div class="form-group">
						        		<label>Tax Name</label>
						        		<input type="text" name="tname" placeholder="Enter Tax name" class="form-control" value="<?= $taxtinfo->taxName ?>">
						        	</div>
						        	<div class="form-group">
						        		<label>Tax Percentage</label>
						        		<input type="number" name="tpercent" placeholder="Enter Tax Percentage" class="form-control" value="<?= $taxtinfo->taxpercent ?>">
						        	</div>
						        	<button type="submit" class="btn btn-primary">Submit</button>
						        </form>
        				</div>
        			</div>
        	</div>
        	<div class="col-md-3"></div>
        </div>
    
</div>
<?php 
    include_once('includes/footer.php');
?>