<?php 
    include_once('includes/header.php');
?>
<script>
    
$(document).ready(function() {
          $('textarea#categoryDetails').summernote();
        });
//     tinymce.init({
//     selector: 'textarea#categoryDetails',
//     plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
//     imagetools_cors_hosts: ['picsum.photos'],
//     menubar: 'file edit view insert format tools table help',
//     toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
//     toolbar_sticky: true,
//     autosave_ask_before_unload: true,
//     autosave_interval: "30s",
//     autosave_prefix: "{path}{query}-{id}-",
//     autosave_restore_when_empty: false,
//     autosave_retention: "2m",
//     image_advtab: true,
//     /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
   
//     importcss_append: true,
//     file_picker_callback: function (callback, value, meta) {
//         /* Provide file and text for the link dialog */
//         if (meta.filetype === 'file') {
//             callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
//         }
    
//         /* Provide image and alt text for the image dialog */
//         if (meta.filetype === 'image') {
//             callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
//         }
    
//         /* Provide alternative source and posted for the media dialog */
//         if (meta.filetype === 'media') {
//             callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
//         }
//     },
//     templates: [
//         { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
//         { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
//         { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
//     ],
//     template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
//     template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
//     height: 600,
//     image_caption: true,
//     quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
//     noneditable_noneditable_class: "mceNonEditable",
//     toolbar_mode: 'sliding',
//     contextmenu: "link image imagetools table",
// });


  </script>
<div class="col-md-10 px-4">
    <div class="text-center">
        <h3><?= $pageInfo->name ?> Page Setting</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/add_new_page')?>" class="btn btn-success btn-sm float-right ml-2" >Add New Page</a>
            <a href="<?= base_url('index.php/admin/pageList')?>" class="btn btn-primary btn-sm float-right " >All Page</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                   <form action="<?= base_url('index.php/admin/page_settingData')?>" method="post" >
                    <input type="hidden" name="page" value="<?= $pageInfo->id ?>">
                     <div class="row">
                        <div class="col-md-12 px-2">
                            <div class="form-group">
                                <label for="catname">Page name</label>
                                <input type="text" name="pagename" id="catname" class="form-control" placeholder="Enter Page name" required value="<?= $pageInfo->name ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-12 px-2">
                            <div class="form-group">
                                <label for="catname">Page Url(Ex: this-is-page-url/ this is page url)</label>
                                <input type="text" name="pageurl" id="catname" class="form-control" placeholder="Enter page url" required value="<?= $pageInfo->seo_url ?>">
                            </div>
                        </div>        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="categoryDetails">Page Content</label>
                                <textarea class="form-control" row="5" name="pageContent" id="categoryDetails"><?php echo $pageInfo->content ?></textarea>
                            </div>
                        
                        </div>
                        <!-- <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Page Title(Optional)</label>
                                <input type="text" name="ptitle" id="catname" class="form-control" placeholder="Enter Page Title">
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Meta Title(Optional)</label>
                                <input type="text" name="mtitle" id="catname" class="form-control" placeholder="Enter Page Title">
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="categoryDetails">Meta Keywords(Optional)</label>
                                <textarea class="form-control" name="mkeywords" ></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="categoryDetails">Meta Description(Optional)</label>
                                <textarea class="form-control" name="mdescription"></textarea>
                            </div>
                        </div> -->
                        
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