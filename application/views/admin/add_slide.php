<?php 
    include_once('includes/header.php');
?>
<script>
    

    tinymce.init({
    selector: 'textarea#sliderDetails',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
   
    importcss_append: true,
    file_picker_callback: function (callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
        }
    
        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
        }
    
        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
        }
    },
    templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
});


  </script>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Add New Slide</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/sliderList')?>" class="btn btn-success btn-sm float-right" >Back Slide List</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                   <form action="<?= base_url('index.php/admin/add_slide_data')?>" method="post" >
                    
                     <div class="row">
                        <div class="col-md-4 px-2">
                            <!-- <div class="form-group">
                                <label for="catname">Choose Slide Image(Required)</label>
                                 <?php 
                                    // $imgurl = "Hello";
                                    // include('includes/imageBox.php');
                                ?>
                            </div> -->
                                <!-- Image Popup -->
                                <label>Product Image</label>
                                <br>
                                <?php 
                                    // $imgurl = "Hello";
                                    include('includes/imageBox.php');
                                ?>
                        </div>
                        
                        <div class="col-md-8 px-2">
                            <div class="form-group">
                                <label for="catname">Slide Link</label>
                                <input type="text" name="slideLink" id="catname" class="form-control" placeholder="Enter Category name" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Alt Text</label>
                                <input type="text" name="altText" id="catname" class="form-control" placeholder="Enter Alt Text">
                            </div>
                        </div>
                        <div class="col-md-3 px-2">
                            <div class="form-group">
                                <label for="catname">Sequence No</label>
                                <input type="number" name="sequence" id="catname" class="form-control" placeholder="Enter Sequence No">
                            </div>
                        </div>
                        <div class="col-md-3 px-2">
                           <label class="form-label">Slider Visibility:</label>
                            <select class="form-control " name="deviceSlide" required >
                                <!-- <option selected value="1">Visible in Desktop Only</option> -->
                                <option  value="2">Visible in Mobile Only</option>
                                <!-- <option  value="3">Visible in all Device</option> -->
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sliderDetails">Slider Text</label>
                                <textarea class="form-control" row="5" name="sliderDetails" id="sliderDetails"></textarea>
                            </div>
                        </div>
                        
                     </div> 
                     <button type="submit" class="btn btn-primary">Submit</button>  
                   </form> 
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

<?php 
    include_once('includes/footer.php');
?>