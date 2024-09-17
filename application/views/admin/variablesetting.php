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
        <h3>Product Variable  Setting</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12 p-2 ">
            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#imageLinkModal">Add New</button>
            <br>
            <hr>  
            <div class="table-responsive">
                <table class="table table-hovered table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Variable Name</th>
                            <th>Variable Type</th>
                            <th>Variable values</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        foreach ($allValues as $varsNValues): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $varsNValues->varname?></td>
                                <td><?= $varsNValues->varTypes?></td>
                                <td><?= $varsNValues->varValues?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('index.php/admin/editVar/'.$varsNValues->id)?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Variable Setting"><i class="fa fa-pencil"></i></a>
                                        <a href="<?= base_url('index.php/admin/deleteVariable/'.$varsNValues->id)?>" onclick="return confirm('Are you sure you want to delete this Variable setting?')"class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Variable"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>   
                        <?php endforeach ?>
                        
                    </tbody>
                </table>
            </div>
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
                    <form action="<?php echo base_url('index.php/admin/addVarData')?>" method="post">
                        <div class="form-group">
                            <label>Varible Name</label>
                            <input type="text" name="vName" class="form-control" placeholder="Enter Varible Name" required>
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
                                <label for="parentcat">Type Your Values</label>
                                <br>
                            <select class="varValues form-control" name="varValues[]" multiple="multiple" required style="width: 100%">
                                <?php 
                                       for($i=0; $i < sizeof($parentArray); $i++) { 
                                        if (array_key_exists($i, $allUniqueValues)) {
                                            ?>
                                                <option value="<?= $allUniqueValues[$i] ?>"><?= $allUniqueValues[$i] ?></option>
                                            <?php
                                            }
                                        } 
                                 ?>
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
        
    });
</script>
<?php 
    include_once('includes/footer.php');
?>