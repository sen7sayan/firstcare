 <!-- Modal -->
    <div class="modal fade" id="imagegettermodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Image</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">X
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nav pill -->
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs " id="customTab3" role="tablist" >
                            <li class="nav-item addimageModal" role="presentation" data-inputid="featureImage">
                                <a class="nav-link active" id="tab-oneAA" data-toggle="tab" href="#oneAA" role="tab"
                                    aria-controls="oneAA" aria-selected="true"><h6><i class="fa fa-image mr-2"></i>Choose Image From Gallery</h6></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="tab-twoAA" data-toggle="tab" href="#twoAA" role="tab"
                                    aria-controls="twoAA" aria-selected="false"><h6><i class="fa fa-upload mr-2"></i>Upload New Image</h6> </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent3">
                            <div class="tab-pane show active " id="oneAA" role="tabpanel">
                                <!-- add Image -->
                                <div class="row" id="allimageList">
                                    
                                </div>
                                <!-- add Image -->
                            </div>

                            <div class="tab-pane fade " id="twoAA" role="tabpanel">
                                <p class="upload-msg"></p>
                                
                                <form method="post" onsubmit="return uploadimageFile(event)">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="input-group">
                                                <input type="hidden" name="" value="" id="setteridContainer" >
                                                <input type="file" multiple class="form-control" id="inputGroupFile" name="userfile[]" aria-label="Upload Now" >
                                                <button class="btn btn-primary disabled imgupload" disabled type="submit">Upload </button>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" id="imageuploadProgress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>    
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- Nav pill -->
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div> 

<script type="text/javascript">

    function setmyimage(sId,imgurl) {
            $("#"+sId).val(imgurl);
            var imgId = "#"+sId+'Src' ;
            $(imgId).attr('src','<?= base_url() ?>'+imgurl);
            $(imgId).css({"height":"70px","width":"70px"})
            
        }

    function uploadimageFile(e,mediaPage=false) {

                e.preventDefault();
                var percentCompleted = 0;
                // var progressContainer = $("#imageuploadProgress > div");

                $(".imgupload").addClass("disabled");
                $(".imgupload").attr("disabled",true);
                 
                 const config = {
                    onUploadProgress: function(progressEvent) {
                    percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                      $("#imageuploadProgress").css("width",percentCompleted+"%")
                      // console.log(percentCompleted+"%")
                    }
                  }

                const formdata = new FormData(e.target);
                formdata.append("userfile[]",formdata.get('userfile')); 
                axios.post("<?= base_url('admin/addimageDataTest')?>", formdata,config).then(function (response) {
                   console.log(response.data)
                    $(".upload-msg").html(response.data.msg);
                    
                    $("#imageuploadProgress").removeClass("bg-primary");
                    $("#imageuploadProgress").addClass(response.data.msgColor);

                    if (response.data.status == 1 ){
                        $(".upload-msg").addClass("text-success");
                        $("#imageuploadProgress").removeClass("bg-primary");
                        $("#imageuploadProgress").addClass("bg-success");

                        var setterId = $("#setteridContainer").val();

                        setmyimage(setterId,response.data.imgpath);
                        $('#imagegettermodal').modal('hide');
                        
                        console.log("This is setter Id "+setterId);

                        if (mediaPage) {
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                        
                      }
                      else{
                        $(".upload-msg").addClass("text-danger");
                      }
                })
                .catch((error) => console.log(error));
                
            }


    $(document).ready(function () {
      
      	

        // Image upload input on change 
                $("#inputGroupFile").on("change",function() {
                    var inputInfo = $(this);
                    // console.log($(this).length);
                    if (inputInfo.length > 0) {
                        $(".imgupload").removeClass("disabled");
                        $(".imgupload").attr("disabled",false);  
                        $("#imageuploadProgress").addClass("bg-primary");      
                        $("#imageuploadProgress").css("width","1%");
                    }
                    else{
                        $(".imgupload").addClass("disabled");
                        $(".imgupload").attr("disabled",true);
                    }
                });
                // Image upload input on change    


        $(".list-img").on("click",function () {
            var imgInfo = $(this);
            var imgId = imgInfo.data("imgid");
            var imgsrc = imgInfo.attr("src");
            $(".imageInfovalue").attr("src",imgsrc);
            $(".deleteImg").attr("data-img-delete",imgId);
        });

        $(".deleteImg").on("click",function() {
            var imageId = $(this).data("img-delete");
            if (confirm("Are you sure want to delete this image")) {
                const formdata = new FormData();
                formdata.append("imgId",imageId); 
                axios.post("<?= base_url('admin/deleteimage')?>", formdata).then(function (response) {
                    if (response.data != "deleted") {
                        alert("Image is not deleted! please try again. ")
                    }
                   location.reload(true);
                })
                .catch((error) => console.log(error));
            }
            
            
        });

        $(".multidelete").on("click",function() {
            var disValue = $(".imgCheckbox").css("display");
            if (disValue == "none") {
                $(".imgCheckbox").css("display","block");
                $(".multidelete").html("Hide Selection")
                $(".multidelete2").css("display","block");
            }
            else{
                $(".imgCheckbox").css("display","none");
                $(".multidelete").html("Delete Multiple");
                $(".multidelete2").css("display","none");
            }
        });


        $(".addimageModal").on("click",function() {
            $("#loader").css("display","block");
      			var imageTag = $(this);
      			var setterId = imageTag.data("inputid");
                  $("#setteridContainer").val(setterId);
      			// console.log(setterId);

      			$("#allimageList").html("Please Wait ...");
      			const formdata = new FormData();
                	formdata.append("setterId",setterId); 
                	axios.post("<?= base_url('admin/allimages')?>", formdata).then(function (response) {
                          	// console.log(response.data);
                          	$("#allimageList").html(response.data)
                            $("#loader").css("display","none");
                          })
                          .catch((error) => console.log(error));

      		});


    });
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

			</div>
		</div>
	</body>
</html>
