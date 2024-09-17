<?php 
    include_once('includes/header.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<style type="text/css">

	.table td, .table th
	{
		padding: 5px ;
	}
	table{
		line-height: 15px;
		word-spacing: 1px;
	}
	table p{
		line-height: 3px;
	}
	.items-line th, td 
	{
		padding: 5px;
		font-size: 10px;
		font-weight: 700;
	}
	.items-line p 
	{
		line-height: 20px;

	}
</style>
<div class="col-md-10 px-4">
	<br>
	<button onclick="makepdf()" class="btn btn-primary btn-lg">Print/Download</button>
	<br>
	 <div class="row">
	 	<!-- <div class="col-md-1"></div>	 -->
	 	<div class="col-md-12">
	 		<div class="card">
	 			<div class="card-body">
	 				<div id="content" class="table-responsive">	
					 	<table class="table table-hovered">
						 	<tbody>
						 		<!-- <tr>
						 			<td colspan="9"><p><b>GST : 07AARCS370531Z0</b></p></td>
						 		</tr> -->
						 		<tr>
						 			<td colspan="9">
						 				<div class="text-center">
						 					<h4 style="text-decoration: underline;" class="text-uppercase">INVOICE</h4>
						 					<h2 style="word-spacing: 10px;"  class="font-weight-bold text-uppercase"><span class="ml-4">SHOP24U Online</h2>
						 					<p class="text-uppercase" style="line-height:1">Kolkatta
												<br>West Bengal</p>
											<!-- <h4 style="text-decoration: underline;font-size: 15px;" class="">MOB - +918377055750(Sales), +91 97117 47000 (complaint)</h4> -->
						 				</div>
						 			</td>
						 		</tr>
						 		<tr>
						 			<td colspan="4">
						 				<p>Invoice No. : <?= $odrInfo->id ?></p>
										<p>Dated : <?php echo date("d-M-Y") ?></p>
										<p>Reverse Charge : N</p>
										<p>GR/RR No. : </p>
										
						 			</td>
						 			<td colspan="4">
						 				<p>Transport : </p>
										<p>Vehicle No :</p>
										<p>Station: </p>
										<p>E-Way Bill No. : </p>
										
						 			</td>
						 		</tr>
						 		<tr>
						 			<td colspan="4">
						 				<p><b>Billed to :</b></p>
						 				<p><b><?= $odrInfo->userid ?></b></p>
						 				<p><?= $odrInfo->companyName ?></p>
						 				<p><?= $odrInfo->billaddress ?></p>
										<p><?= $odrInfo->userPhone ?></p>
										<p><?= $odrInfo->email ?></p>
										<p><b>GSTIN/UIN :<?= $odrInfo->gstNumber ?></b></p>
						 			</td>
						 			<td colspan="4">
						 				<p><b>Ship to :</b></p>
						 				<p><b><?= $odrInfo->userid ?></b></p>
						 				<p><?= $odrInfo->companyName ?></p>
						 				<p><?= $odrInfo->shipaddress ?></p>
										<p><?= $odrInfo->userPhone ?></p>
										<p><?= $odrInfo->email ?></p>
										<p><b>GSTIN/UIN :<?= $odrInfo->gstNumber ?></b></p>
						 			</td>
						 		</tr>
						 		<tr></tr>
						 	</tbody>
						 </table>
				 		<table class="table items-line">
								 	<tbody>
								 		<tr >
								 			<th><p>Sn. No.</p></th>
								 			<th><p>Image</p></th>
								 			<th><p>Description of Goods</p></th>
								 			<th><p>HSN/SAC    
							Code</p></th>
											<th>
												<p>Qty.</p>
											</th>
											<th>
												<p>Unit.</p>
											</th>
											<th>
												<p>
													Unit Price
												</p>
											</th>
											<th>
												<p>
													IGST Rate
												</p>
											</th>
											<th>
												<p>
													IGST Amount(&#8377;)
												</p>
											</th>
											<th>
												<p>
													Amount(&#8377;)
												</p>
											</th>

								 		</tr>

								 		<?php
								 			$odrData = (unserialize($odrInfo->orderDetail));
								 			$j=1;
								 			$totalQty = 0;
								 			$totalAmt = 0;
								 			for ($i=0; $i < sizeof($odrData) ; $i++) { 
								 					$prId = $odrData[$i]["id"];
								 					$proInfo = $this->db->where("id",$prId)->get("products")->row();
								 				?>
													<tr class="table-bordered">
										 				<td style="width:10px"><?= $j++; ?></td>
										 				<td><img src="<?= base_url($proInfo->featureImg) ?>" style="height:70px;width: 70px;"></td>
										 				<td><p><?= $odrData[$i]["name"]?>
										 					<?php 
										 						if ($odrData[$i]["options"]["variable"]){
					                                             echo "<br>(".$odrData[$i]["options"]["variable"].")";
					                                            }
										 					 ?>
										 				</p></td>
										 				<td><?= $proInfo->pro_hsn ?></td>
										 				<td><?php 
										 					$oq = $odrData[$i]["qty"];
										 					echo $oq;
										 					$totalQty = $totalQty + $oq;
										 				
										 			?></td>
										 			<td>
										 				<?php 
										 					echo "Pcs" ;
										 				 ?>
										 			</td>
										 				<td>&#8377;<?= $odrData[$i]["price"]?></td>
										 				<td>
										 					<?php 
										 						$totalTaxPer = 0;

										 						if (isset($odrData[$i]["options"]["tax"])){
										 					    $taxslab = $proInfo->taxSlab;
					                                             $taxArr = explode(",", $taxslab);
					                                             for ($k=0; $k < count($taxArr) ; $k++) { 
					                                             	$taxInfo= $this->db->where("id",$taxArr[$k])->get("taxes")->row();
					                                             	$totalTaxPer = $totalTaxPer + $taxInfo->taxpercent;
					                                             	
					                                             }
					                                             echo $totalTaxPer;
					                                            }
										 					 ?>%
										 					 
										 					 
										 				</td>
										 				<td>
										 					<?php 
										 						  echo $taxPrice = ($odrData[$i]["subtotal"] * $totalTaxPer)/100;

										 					 ?>
										 					 <?php if ($odrData[$i]["options"]["taxType"] == "included"): ?>
										 					 	<br><small class="text-secondary">(Tax included in price)	</small>
										 					 <?php endif ?>
										 				</td>
										 				<td>&#8377;<?php 

										 				if ($odrData[$i]["options"]["taxType"] == "included"){
										 					echo $prWithTax = $odrData[$i]["subtotal"] ;
										 					
										 				}
										 				else{
										 					echo $prWithTax = $odrData[$i]["subtotal"] + $taxPrice;	
										 				}

										 				
										 				$totalAmt = $totalAmt + $prWithTax;
										 				?></td>
										 			</tr>
													<?php
												}
								 		 	
								 		 		
								 		 		?>
								 			<tr class="table-bordered">
									 			<td colspan="4"><p><b>Total</b></p></td>
									 			<td><p><b><?= $totalQty ?></b></p></td>
									 			<td class="pt-3">Pcs.</td>
									 			<td colspan="3"></td>
									 			<td ><p><b>&#8377; <?= $totalAmt?></b></p></td>
									 		</tr>
									 		
									 		<tr class="table-bordered">
								 			<td colspan="3" style="line-height: 1;">
								 				<p style="text-decoration: underline;"><b>Terms and Conditions</b></p>
								 				<ol>
							 						<li>
								 						Goods Once sold, Will not be tacken back	
								 					</li>
								 					<li>
								 						Interest @ 18% p.a. will be charged if the payment is not made with in the stimulated time
								 					</li>
								 					<li>
								 						Subject to "Delhi" jurisdiction only
								 					</li>
								 				</ol>
								 			</td>
								 			<td colspan="7">
								 				<small>Reciever signature :</small>
								 				<!-- <br>
								 				<hr>
								 				<br><br><br><br><br><br><br><br><br>
								 				<h5 class="text-right"><b>For SCOOBEE PET FOODS PVT. LTD DELHI</b></h5>
								 				<p class="text-right"><b>Authorised Signatory</b> </p> -->
								 			</td>
								 		</tr>

								 	</tbody>
								 </table>
					 </div>
	 			</div>
	 		</div>
	 	</div>
	 	<div class="col-md-1"></div>
	 </div>
</div>
<script type="text/javascript">
	function makepdf() {
			window.jsPDF = window.jspdf.jsPDF;

			var doc = new jsPDF();
				
			// Source HTMLElement or a string containing HTML.
			var elementHTML = document.querySelector("#content");

			doc.html(elementHTML, {
			    callback: function(doc) {
			        // Save the PDF
			        doc.save('sample-document.pdf');
			    },
			    x: 15,
			    y: 15,
			    width: 170, //target width in the PDF document
			    windowWidth: 650 //window width in CSS pixels
			});
		}
</script>
<?php 
    include_once('includes/footer.php');
?>