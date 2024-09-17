<?php 
    include_once('includes/header.php');
?>
<script type="text/javascript">
    $(document).ready(function() {
          $('textarea#categoryDetails').summernote();
        });
</script>
<style type="text/css">
    .showImg{
        width: 100%;
        height: 100px;
        object-fit: fill;
    }
</style>

<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Product Variable  Setting</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12 p-2 ">
            <div class="btn-group">
                <button class="btn btn-success btn-sm" data-toggle="modal"  data-target="#imageLinkModal" title="Add more variables to this product"><i class="fa fa-sort-numeric-asc mr-2"></i> Add Variable</button>

                <button data-toggle="tooltip" title="Regenerate all Combination of variables" class="btn btn-warning btn-sm" id="gen" onclick="regenerate(<?= $proId ?>)"><i class="fa fa-gears mr-2"></i> Regenerate Combination</button>

                <a data-toggle="tooltip" title="All variable list and Setting" href="<?= base_url('index.php/admin/variableSetting')?>" class="btn btn-info btn-sm"><i class="fa fa-gear mr-2"></i> Varable Setting</a>

                <a data-toggle="tooltip" title="Back to product list" href="<?= base_url('index.php/admin/product_list')?>" class="btn btn-primary btn-sm"><i class="fa fa-list-ol mr-2"></i> Product List</a>
            </div>
            <br>
            <hr>  
            <div class="table-responsive">
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Variable Name</th>
                            <th>Variable values</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        foreach ($productVariableList as $prVariables): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $prVariables->varname?></td>
                                <td><?= $prVariables->varvalues?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('index.php/admin/editProVariable/'.$prVariables->id)?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Variable Setting"><i class="fa fa-pencil"></i></a>
                                        <a href="<?= base_url('index.php/admin/deleteProVariable/'.$prVariables->id)?>" onclick="return confirm('Are you sure you want to delete this Variable setting?')"class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Variable"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>   
                        <?php endforeach ?>
                        
                    </tbody>
                </table>
            </div>
            <br>

        <?php 
            $proInfo = $this->db->where("id",$proId)->get("products")->row();
            $proVariables = $this->db->where("proId",$proId)->get("productvariabledetails")->result();
            // print_r($proVariables);
         ?>
         <div class="d-flex">
             <h2 class="text-success mr-3"><?= $proInfo->name ?></h2>
             <a data-toggle="tooltip" data-placement="left" title="Edit this Product" href="<?= base_url('admin/edit_products/'.$proInfo->id)?>" class="btn btn-primary btn-sm">edit Product</a>
         </div>
         <br>
         <?php foreach ($proVariables as $pVariable): ?>
             <form method="post" onsubmit="return addProVariable(event)" enctype="multipart/form-data">
                <div class="row p-3 border border-danger">
                 <div class="col-6">
                    <h5 class="text-success"><?= $proInfo->name ?></h5>
                        <?php 
                            $comb = $pVariable->combinations;
                            $combArray = explode(",", $comb);
                            for ($i=0; $i < sizeof($combArray) ; $i++) { 
                                echo '<button type="button" class="btn btn-outline-danger px-5 py-0 mr-2">'.$combArray[$i].'</button>';
                            }
                         ?>
                        <hr>
                        <input type="hidden" name="proVariableId" value="<?= $pVariable->id ?>">
                        <div class="row pt-4">
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="pprice">Price(₹)</label>
                                    <input type="number" name="pPrice" id="pprice" class="form-control" placeholder="Product Price" value="<?= $pVariable->price ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="disprice">Discounted Price(₹)</label>
                                    <input type="number" name="disPrice" id="disprice" class="form-control" placeholder="Product Discount Price" value="<?= $pVariable->dis_price ?>" >
                                </div>
                            </div>
                            <div class="col-md-4 px-2">
                                <div class="form-group">
                                    <label for="procode">Product Code</label>
                                    <input type="text" name="procode" id="procode" class="form-control" placeholder="Product Code" value="<?= $pVariable->productCode ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="form-group">
                                  <label for="disprice">Stock Status</label>
                                  <select name="stockstatus" id="parentcat" class="form-control">
                                    <?php 
                                        if($pVariable->stockStatus == 1) {
                                            $inStk = "selected";
                                            $outStk = "";
                                        }
                                        else
                                        {
                                            $inStk = "";
                                            $outStk = "selected";
                                        }
                                     ?>
                                    <option <?= $inStk ?> value="1">In-Stock</option>
                                    <option <?= $outStk ?> value="0">Out of Stock</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6 px-2">
                              <div class="form-group">
                                <label for="stockqty">Stock Qty.</label>
                                <input type="number" name="stockqty" id="stockqty" class="form-control" placeholder="Product Stock QTY."  required value="<?= $pVariable->stockQty ?>">
                              </div>
                            </div>
                        </div>
                     </div>
                <div class="card-body col-6">
                    <div class="form-group">
                        <label for="stockqty">Short Description</label>
                        <textarea id="categoryDetails" class="form-control" placeholder="Variable Product Short Description." name="shortDescription" rows="7"><?= $pVariable->description ?></textarea>
                    </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
             </div>    
             </form>
         <?php endforeach ?>
         
            <hr>
            <?php
                $numOfVars = count($productVariableList);
                $varDetails = $this->db->where("proId",$proId)->get("productvariabledetails")->result();
                $varDetailCount = count($varDetails);
                if ($numOfVars == 1 && $varDetailCount == 0) {
                    foreach ($productVariableList as $varies) {
                        $arr1 = explode(",", $varies->varvalues);
                        for ($i=0; $i < sizeof($arr1) ; $i++) { 
                            $data = array(
                                'proId' => $proId, 
                                'combinations' =>$arr1[$i] , 
                                'combinationType'=>1
                            );
                            $this->db->insert("productvariabledetails",$data);
                        }
                    }
                }
                elseif ($numOfVars == 2) {
                        $checkSecondVar = $this->db->where("proId",$proId)->where("combinationType",2)->get("productvariabledetails")->result();
                        if (count($checkSecondVar)==0) {
                            $this->db->where("proId",$proId)->delete("productvariabledetails");
                            $i=1;
                        foreach ($productVariableList as $varies2) {
                                if ($i==1) {
                                    $arr2 = explode(",", $varies2->varvalues);
                                }
                                elseif ($i==2) {
                                    $arr3 = explode(",", $varies2->varvalues);
                                }
                                $i++;
                                
                            }
                            
                            for ($j=0; $j < sizeof($arr2) ; $j++) { 
                                for ($k=0; $k < sizeof($arr3) ; $k++) { 
                                    $v = $arr2[$j].",".$arr3[$k];
                                    $data = array(
                                    'proId' => $proId, 
                                    'combinations' =>$v, 
                                    'combinationType'=>2
                                );
                                $this->db->insert("productvariabledetails",$data);
                                }
                            }


                        }

                }
                elseif($numOfVars == 3) {
                        $checkSecondVar = $this->db->where("proId",$proId)->where("combinationType",3)->get("productvariabledetails")->result();
                        if (count($checkSecondVar)==0) {
                            $this->db->where("proId",$proId)->delete("productvariabledetails");
                            $i=1;
                        foreach ($productVariableList as $varies3) {
                                if ($i==1) {
                                    $arrF = explode(",", $varies3->varvalues);
                                }
                                elseif ($i==2) {
                                    $arrS = explode(",", $varies3->varvalues);
                                }
                                 elseif ($i==3) {
                                    $arrT = explode(",", $varies3->varvalues);
                                }
                                $i++;
                                
                            }
                            for ($j=0; $j < sizeof($arrF) ; $j++) { 
                                for ($k=0; $k < sizeof($arrS) ; $k++) { 
                                    for ($l=0; $l < sizeof($arrT) ; $l++) { 
                                        $third = $arrF[$j].",".$arrS[$k].",".$arrT[$l];
                                            $data = array(
                                            'proId' => $proId, 
                                            'combinations' =>$third, 
                                            'combinationType'=>3
                                        );
                                        $this->db->insert("productvariabledetails",$data);
                                    }
                                    
                                }
                            }


                        }
                        

                }
                
              ?>
                    
            
        </div>
    
    </div>
    <!-- Modal -->
        <div class="modal" id="imageLinkModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?php echo base_url('index.php/admin/addProVarData')?>" method="post">
                        <input type="hidden" name="proId" value="<?= $proId ?>">
                        <input type="hidden" name="varType" value="text">
                        <div class="form-group">
                            <label>Select Variable Name</label>
                            <br>
                            <select class="form-control prVariable" name="varName" required style="width: 100%" required onchange="getVarValues(this)">
                                <option value="0">Select Variable Name</option>
                                <?php foreach ($allValues as $ProVariables): ?>
                                    <option  value="<?= $ProVariables->id ?>"><?= $ProVariables->varname ?></option>
                                <?php endforeach ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parentcat">Type Your Values</label>
                            <br>
                            <select class="varValues form-control" name="varValues[]" multiple="multiple" required style="width: 100%" id="addvarValues">
                                
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
        </div>
        <!-- Modal -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.varValues').select2({
            placeholder: 'Type Your Values',
            dropdownAutoWidth:true,
            allowClear:true,
            tags:true,
            closeOnSelect:false,
        });
        $('.prVariable').select2({
            placeholder: 'Choose Variables',
            dropdownAutoWidth:true,
            allowClear:true,
            
        });
        
        
    });
    

</script>
<script>
        function getVarValues(varId) {
            var values = varId.value;
            if (values == 0) {
                alert("Please Select a variable!")
            }
            else
            {
                var x = document.getElementById("addvarValues");
                x.innerHTML = "";
                axios.get("<?= base_url('index.php/admin/getVarValues/')?>"+ values).then(function (response) {
                    // console.log(response.data)
                    var string = response.data;
                    let newArray = string.split(',');
                    for (var i = 0; i < newArray.length; i++) {
                        var option = document.createElement("option");
                        option.text = newArray[i];
                        x.add(option);    
                    }
                })
                .catch((error) => console.log(error.response.data.errors));
            }
        }

        function regenerate(proid) {
            var genBtn = document.getElementById("gen");
            genBtn.disabled = true;
            genBtn.innerHTML = "Please wait...";
            var load = document.getElementById("loader");
            load.style.display="block"
            if (confirm("Are your sure to regenerate all variable combinations! you will lose all previous variable setting data for this product!") == true) {
                axios.get("<?= base_url('index.php/admin/regenerate/')?>"+ proid).then(function (response) {
                    if (response.data == "reset") {
                        window.location.reload();
                    }
                    else
                    {
                        alert("Try Again");
                    }
                    genBtn.disabled = false;
                    genBtn.innerHTML = "Regenerate Combination";
                   
                })
                .catch((error) => console.log(error.response.data.errors));
            }
            else
            {
                genBtn.disabled = false;
                genBtn.innerHTML = "Regenerate Combination";
            }
            load.style.display="none"
        }
    </script>
    <script>
         function addProVariable(e) {
            e.preventDefault();
            var load = document.getElementById("loader");
            load.style.display="block"
            
            const formdata = new FormData(e.target);
            formdata.append("proVariableId",formdata.get('proVariableId'));
            formdata.append("pPrice",formdata.get('pPrice'));
            formdata.append("disPrice",formdata.get('disPrice'));
            formdata.append("stockstatus",formdata.get('stockstatus'));
            formdata.append("stockqty",formdata.get('stockqty'));
            formdata.append("proCode",formdata.get('procode'));
            formdata.append("shortDescription",formdata.get('shortDescription'));
            

            // console.log(formdata);
             axios.post("<?= base_url('index.php/admin/updateVariableValues')?>", formdata).then(function (response) {
                    load.style.display="none";
                    if (response.data == "success") {
                        alert("Updated")
                    }
                    else
                    {
                        alert("Try again")   
                    }
                // do whatever you want if console is [object object] then stringify the response
            })
            .catch((error) => console.log(error));
         }
    </script>
<?php 
    include_once('includes/footer.php');
?>