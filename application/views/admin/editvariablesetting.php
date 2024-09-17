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
    <a href="<?= base_url('index.php/admin/variableSetting') ?>" class="btn btn-primary btn-lg" >Back to List</a>
            <br>
            <hr>  
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 p-2 card">
            
            <div class="card-body">
             <form action="<?php echo base_url('index.php/admin/editVarSetData')?>" method="post">
                        <div class="form-group">
                            <label>Varible Name</label>
                            <input type="text" name="vName" class="form-control" placeholder="Enter Varible Name" required value="<?= $singleVarInfo->varname ?>">
                            <input type="hidden" name="varId" value="<?= $singleVarInfo->id ?>">
                        </div>
                        <div class="form-group">
                            <label>Variable Type</label>
                            <select name="vtype" class="form-control">
                                <option value="text">Text</option>    
                                <!-- <option value="text">Color</option>    
                                <option value="text">Image</option>     -->
                            </select>
                        </div>
                        <div class="form-group">
                                <label for="parentcat">Type Your Values </label>
                                <br>
                            <select class="varValues form-control" name="varValues[]" multiple="multiple" required style="width: 100%">
                                <?php 

                                             $valArray = explode(",", $singleVarInfo->varValues);
                                       for($i=0; $i < sizeof($parentArray); $i++) { 
                                                if (array_key_exists($i, $allUniqueValues)) {
                                                    if (in_array($allUniqueValues[$i], $valArray)) {
                                                        $select = "selected";
                                                        }
                                                        else
                                                        {
                                                            $select = "";   
                                                        }
                                                
                                                
                                            ?>
                                                <option <?= $select ?> value="<?= $allUniqueValues[$i] ?>"><?php echo $allUniqueValues[$i] ?></option>
                                            <?php
                                            }
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
        
    });
</script>
<?php 
    include_once('includes/footer.php');
?>