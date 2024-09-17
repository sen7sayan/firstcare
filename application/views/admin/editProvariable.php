<?php 
    include_once('includes/header.php');
?>
<style type="text/css">
    .showImg{
          width: 100%;
            height: 100px;
            object-fit: fill;
    }
</style>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Product Variable  Edit</h3>
        <hr>
    </div>
    <a href="<?= base_url('index.php/admin/productVariableSetting/'.$proVarInfo->proId) ?>" class="btn btn-primary btn-lg" >Back to List</a>
            <br>
            <hr>  
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 p-2 card">
            
            <div class="card-body">
              <form action="<?php echo base_url('index.php/admin/editProVarData')?>" method="post">
                        <input type="hidden" name="proId" value="<?= $proVarInfo->proId ?>">
                        <input type="hidden" name="proVarId" value="<?= $proVarInfo->id ?>">
                        <div class="form-group">
                            <label>Select Variable Name</label>
                            <br>
                            <select class="form-control prVariable" name="varName" required style="width: 100%" required onchange="getVarValues(this)">
                                <option value="0">Select Variable Name</option>
                                <?php foreach ($allValues as $ProVariables): 
                                       if ($proVarInfo->varId == $ProVariables->id) {
                                            $selectVar = "selected";
                                        } 
                                        else
                                        {
                                            $selectVar = "";
                                        }
                                    ?>
                                    <option <?= $selectVar ?>  value="<?= $ProVariables->id ?>"><?= $ProVariables->varname ?></option>
                                <?php endforeach ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                                <label for="parentcat">Type Your Values</label>
                                <br>
                                <?php 
                                    $allSingleVarValues = explode(",", $varvalueInfo);
                                    $preSelVarValues = explode(",", $proVarInfo->varvalues);
                                 ?>
                            <select class="varValues form-control" name="varValues[]" multiple="multiple" required style="width: 100%" id="addvarValues">
                                <?php   
                                    for ($i=0; $i < sizeof($allSingleVarValues); $i++) { 
                                            if (in_array($allSingleVarValues[$i], $preSelVarValues)) {
                                                $selPrvarVal = "selected";
                                            }
                                            else
                                            {
                                                $selPrvarVal = "";
                                            }
                                        ?>
                                            <option <?= $selPrvarVal ?> value="<?= $allSingleVarValues[$i] ?>"><?= $allSingleVarValues[$i] ?></option>
                                        <?php
                                    }
                                 ?>
                                
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>  
        </div>
        <div class="col-md-3"></div>
    
    </div>
    
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
            disabled:true
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
         
    </script>
<?php 
    include_once('includes/footer.php');
?>