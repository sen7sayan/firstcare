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
<style type="text/css">
    .list-img{
        height: 80px;
        cursor: pointer;
    }
    .imgCheckbox{
        position: absolute;
        width: 20px;
        height: 20px;
        display: none;
    }
    .multidelete2{
        display: none;
    }
 </style>
<div class="col-md-10 px-4">

    <!-- Row start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-320">
                        <button class="ml-auto btn btn-outline-primary my-2" data-toggle="collapse"
                                    data-target="#addImage_media" aria-expanded="true"
                                    aria-controls="addImage_media">Add Image</button>
                        <button class="ml-auto multidelete btn btn-outline-danger my-2">Delete Multiple</button>
                        <div id="addImage_media" class="collapse">
                            <!-- Add media form -->
                            <form method="post" onsubmit="return uploadimageFile(event,true)">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="input-group">
                                            <input type="file" multiple class="form-control" id="inputGroupFile" name="userfile[]" aria-label="Upload Now" accept="image/png, image/gif, image/jpeg, image/svg">
                                            <button class="btn btn-primary disabled imgupload" disabled type="submit">Upload Now</button>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" id="imageuploadProgress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>

                                    </div>
                                </div>    
                            </form>
                            <!-- Add media form -->
                        </div>

                        <form method="post" action="<?= base_url('admin/delete_multiple_images')?>">
                            <button type="submit" class="btn btn-danger my-3 multidelete2">Delete Selected Images</button>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($allImages as $imgs): ?>
                                <div class="p-2">
                                    <div class="card p-0">
                                        <div class="card-body p-0" style="height:100px">
                                            <input type="checkbox" name="imageIds[]" value="<?= $imgs->id ?>" class="imgCheckbox" >
                                            <img src="<?= base_url($imgs->path)?>" class="list-img" data-toggle="modal" data-target="#imageLinkModal" onclick="enlargeImg('<?= $imgs->path ?>','<?=  $imgs->id ?>')">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            
                        </div>
                        <button type="submit" class="btn btn-danger mt-3 multidelete2">Delete Selected Images</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- <div class="text-center">
        <h3>Image Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-12 p-2 ">
            <button class="btn btn-success btn-sm float-right" data-toggle="collapse" data-target="#addimage">Add Image</button>
            <div id="addimage" class="collapse">
                <form method="post" enctype="multipart/form-data" action="<?= base_url('index.php/admin/addimageDataTest')?>">
                    
                    <div class="form-group">
                        <label for="image"></label>
                        <input class="btn btn-success" name="userfile[]" type="file"  accept="image/x-png,image/gif,image/jpeg,image/x-png,image/gif,image/svg+xml,application/pdf,video/mp4,video/x-m4v,video/*" multiple="multiple" />
                    </div>
                    <button class="btn-primary btn btn-lg" type="submit">Upload Image</button>
                </form>
            </div>
        </div>
        
       <?php    
            /*if (!empty($allImages)) {
                foreach ($allImages as $gallery) {
                    ?>
                        <div class="col-md-2 p-2 m-2 border rounded-top" style="cursor:pointer" data-toggle="modal" data-target="#imageLinkModal" onclick="enlargeImg('<?= $gallery->path ?>','<?=  $gallery->id ?>')">
                            <img src="<?= base_url($gallery->path)?>" class="showImg" >
                      </div>               
                    <?php
                }
            }
            else
            {
                echo "<h2>No images found</h2>";
            }*/

        ?> 
    
    </div> -->
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
                    <img src="#" alt="" id="bigImg" class="img-fluid">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    
                    <input type="text" id="bigImgUrl" class="form-control">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <a href="" class="btn btn-danger" id="deleteImg" onclick="return confirm('Are you sure to delete selected item?')" >Delete</a>
                </div>

                </div>
            </div>
        </div>
        <!-- Modal -->
</div>

<script>
       function enlargeImg(ImgLink,imgId) {
        document.getElementById("bigImgUrl").value = "<?= base_url()?>" + ImgLink;
            document.getElementById("bigImg").src = "<?= base_url()?>" + ImgLink;
            document.getElementById("deleteImg").href ="<?= base_url('index.php/admin/deleteImage')?>/"+imgId ;

       } 
       /* function handleOnchange(e) {
        e.preventDefault();
        const formdata = new FormData(this);
                
            axios.post("/admin/addImageData", {inder: "inderdata"}).then(function (response) {
                    console.log(response.data)
                    // do whatever you want if console is [object object] then stringify the response
                })
                .catch((error) => console.log(error.response.data.errors.inder));
       }  */
</script>

<?php 
    include_once('includes/footer.php');
?>