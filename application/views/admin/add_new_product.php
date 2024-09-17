<?php 
    include_once('includes/header.php');
?>
<script>
    $(document).ready(function() {
          $('textarea#shortDetails, textarea#longDetails, textarea#featureeDetails, textarea#additionalDetails').summernote();
        });

//     tinymce.init({
//     selector: 'textarea#shortDetails, textarea#longDetails, textarea#featureeDetails, textarea#additionalDetails',
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
//     height: 300,
//     image_caption: true,
//     quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
//     noneditable_noneditable_class: "mceNonEditable",
//     toolbar_mode: 'sliding',
//     contextmenu: "link image imagetools table",
// });


  </script>
  

<div class="col-md-10 px-4">
    <div class="text-center">
        <h3>Add New Product</h3>
        <hr>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-1 "></div>
        <div class="col-md-10 p-2 ">
            <!-- add new cat -->
            <a href="<?= base_url('index.php/admin/product_list')?>" class="btn btn-success btn-sm float-right" >Back Product List</a>
            <!-- add new cat -->
            <br><hr>
            <div class="card">
                <div class="card-body p-3">
                   <form action="<?= base_url('index.php/admin/add_products_data')?>" method="post" >
                    
                     <div class="row">
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Product Name</label>
                                <input type="text" name="proName" id="catname" class="form-control" placeholder="Enter Product name" required>
                            </div>
                        </div>
                        <div class="col-md-3 px-2">
                            <div class="form-group">
                                <input type="text" name="proCode" class="form-control" placeholder="Enter Product Code" required>
                                <input type="text" name="proHsn" class="mt-1 form-control" placeholder="Enter HSN Code" required>
                            </div>
                        </div>
                        
                        <div class="col-md-3 px-2">
                            <div class="form-group">
                                <label for="ptype">Product Type</label>
                                <select name="protype" id="ptype" class="form-control">
                                    <option value="1">Simple</option>
                                    <option value="2">Variable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="parentcat">Prime Product Category</label>
                                <select name="proCat" id="parentcat" class="parentCat form-control">
                                    <?php 
                                        if(!empty($allcats)) {
                                            foreach ($allcats as $category) {
                                                ?>
                                                   <option value="<?= $category->id ?>"><?= $category->name ?></option> 
                                                <?php
                                            }
                                        }
                                     ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                
                                <label for="parentcat">Other Product Categories</label>
                                <select class="otherCats form-control" name="otherCats[]" multiple="multiple" >
                                    <?php 
                                        if(!empty($allcats)) {
                                            foreach ($allcats as $category) {
                                                ?>
                                                   <option value="<?= $category->id ?>"><?= $category->name ?></option> 
                                                <?php
                                            }
                                        }
                                     ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">SEO Url (Ex:seo-url-example)</label>
                                <input type="text" name="seoUrl" id="catname" class="form-control" placeholder="Enter SEO Url(Ex:seo-url-example)"  required>
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="form-group">
                                <label for="catname">Featured Image(Optional)</label>
                                <?php 
                                    // $imgurl = "Hello";
                                    include('includes/imageBox.php');
                                ?>
                                <input type="hidden" name="proThumbnail" value="1">
                            </div>
                        </div>
                        <div class="col-md-6 py-2 px-4">
                            <div class="row border border-primary rounded">
                                <div class="col-md-6 px-2">
                                    <div class="form-group">
                                        <label for="pprice">Price(₹)</label>
                                        <input type="number" name="pPrice" id="pprice" class="form-control" placeholder="Product Price"  required>
                                    </div>
                                </div>
                                <div class="col-md-6 px-2">
                                    <div class="form-group">
                                        <label for="disprice">Discounted Price(₹)</label>
                                        <input type="number" name="disPrice" id="disprice" class="form-control" placeholder="Product Discount Price">
                                    </div>
                                </div> 
                                <div class="col-md-6 px-2">
                                    <div class="form-check pt-3">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="taxinclude" value="1">Tax is Included price
                                      </label>
                                    </div>
                                </div> 
                                <div class="col-md-6 px-2">
                                    <div class="form-group">
                                        <?php 
                                            $taxList = $this->db->order_by("id","desc")->where("status","1")->get("taxes")->result();
                                         ?>
                                         
                                        <label for="pprice">Select Tax Slab</label>
                                        <select class="taxes form-control" name="taxes[]" multiple="multiple">
                                            <?php if (count($taxList)): ?>
                                                <?php foreach ($taxList as $tList): 
                                                        if ($tList->its_default == 1) {
                                                            $default = "selected";
                                                        }
                                                        else
                                                        {
                                                            $default = "";
                                                        }
                                                    ?>
                                                  <option <?= $default ?> value="<?= $tList->id ?>"><?= $tList->name." (".$tList->taxpercent."%)" ?></option>    
                                                <?php endforeach ?>
                                           <?php endif ?>
                                         </select>
                                         
                                    </div>
                                </div>    
                            </div>
                        </div>

                        
                        <div class="col-md-6 py-2 px-4">
                            <div class="row border border-primary rounded">
                                <div class="col-md-6 px-2">
                                    <div class="form-group">
                                        <label for="disprice">Stock Status</label>
                                        <select name="stockstatus" id="parentcat" class="form-control">
                                            <option value="1">In-Stock</option>
                                            <option value="0">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 px-2">
                                    <div class="form-group">
                                        <label for="stockqty">Stock Qty.</label>
                                        <input type="number" name="stockqty" id="stockqty" class="form-control" placeholder="Product Stock QTY."  required value="0">
                                    </div>
                                </div>
                                <div class="col-md-12 px-2">
                                    <div class="form-group">
                                        <label for="moqty">Minimum Order Qty.(Default is 1)</label>
                                        <input type="number" name="moq" id="moqty" class="form-control" placeholder="Minimum Order Qty.(Default is 1)"  required value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="pprice">Cross Sell Products</label>
                            <?php 
                                $prolist = $this->db->order_by('id',"desc")->get("products")->result();
                             ?>
                            <select class="cross_products form-control" name="cross_products[]" multiple="multiple">
                                <?php foreach ($prolist as $proinfo): ?>
                                    <option value="<?= $proinfo->id ?>"><?= $proinfo->name ?></option>    
                                <?php endforeach ?>
                            </select>
                        </div>    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shortDetails">Short Description</label>
                                <textarea class="form-control" row="5" name="shortDetails" id="shortDetails"></textarea>
                            </div>
                        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="featureeDetails">Feature Points</label>
                                <textarea class="form-control" row="5" name="featureeDetails" id="featureeDetails"></textarea>
                            </div>
                        
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="longDetails">Long Description</label>
                                <textarea class="form-control" row="5" name="longDetails" id="longDetails"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="additionalDetails">Additional Information</label>
                                <textarea class="form-control" row="5" name="additionalDetails" id="additionalDetails"></textarea>
                            </div>
                        
                        </div>

                        <div class="col-md-6 px-2">
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
                        </div>
                        
                     </div> 
                     <button type="submit" class="btn btn-primary">Submit</button>  
                   </form> 
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    
<script type="text/javascript">

    $(document).ready(function() {
        $('.otherCats').select2({
            placeholder: 'Select More categories',
            width: 'resolve',
            allowClear:true,
            dropdownAutoWidth:true,
            closeOnSelect:false,
        });
        $('.taxes').select2({
            placeholder: 'Select Taxes',
            width: 'resolve',
            allowClear:true,
            dropdownAutoWidth:true,
            closeOnSelect:false,
        });

        $('.cross_products').select2({
            placeholder: 'Select Taxes',
            width: 'resolve',
            allowClear:true,
            dropdownAutoWidth:true,
            closeOnSelect:false,
        });
        

        $('.parentCat').select2({
            placeholder: 'Select Product category',
            width: 'resolve',
            allowClear:true,
            dropdownAutoWidth:true,
            
        });
       
    });





</script>
<?php 
    include_once('includes/footer.php');
?>