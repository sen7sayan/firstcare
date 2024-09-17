<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Menu Setting</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/menu/')?>bootstrap-iconpicker/css/bootstrap-iconpicker.min.css">
        
            
        </head>
        <body>
        <div id="loader" class="text-center">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-light"></div>    
            </div>
        </div>
        <style type="text/css">
            #loader{
                display: none;
                width: 100%;
                height: 100%;
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 9999;
                background-color: #0000005e;
            }   
        </style>
        <div class="row mt-5 p-5">
                <?php 
                    include_once("includes/left-sidebar.php")
                ?>
                <div class="col-md-10">
                    <div class="text-center">
                        
                        <h3>
                            <?php if ($menuInfo->id == 2): ?>
                                Category Menu
                            <?php elseif ($menuInfo->id == 1) : ?>
                                Main Menu
                            <?php endif ?>
                            Setting</h3>
                    </div>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header"><h5 class="float-left">Menu</h5>
                                    <div class="float-right">
                                        <button id="btnReload" type="button" class="btn btn-outline-secondary">
                                            <i class="fa fa-play"></i> Refresh Menu</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul id="myEditor" class="sortableLists list-group">
                                    </ul>
                                </div>
                            </div>
                            <!-- <p>Click the Output button to execute the function <code>getString();</code></p> -->
                            <div class="card">
                                <div class="card-header">After Changes Please save
                                    <div class="float-right">
                                        <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Save Menu Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-primary mb-3">
                                <div class="card-header bg-primary text-white">Edit item</div>
                                <div class="card-body">
                                    <form id="frmEdit" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="text">Text</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                                <div class="input-group-append">
                                                    <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="icon" class="item-menu">
                                        </div>
                                        <div class="form-group">
                                            <label for="href">URL</label>
                                            <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                                        </div>
                                        <div class="form-group">
                                            <label for="target">Target</label>
                                            <select name="target" id="target" class="form-control item-menu">
                                                <option value="_self">Self</option>
                                                <option value="_blank">Blank</option>
                                                <option value="_top">Top</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Tooltip</label>
                                            <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                                    <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src='<?= base_url('assets/menu/')?>jquery-menu-editor.js'></script>
<script type="text/javascript" src="<?= base_url('assets/menu/')?>bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/menu/')?>bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script>
jQuery(document).ready(function () {
                
                var arrayjson = <?php if($menuInfo->content) { echo $menuInfo->content;}else{echo "[]";} ?>;
                // icon picker options
                var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
                // sortable list options
                var sortableListOptions = {
                    placeholderCss: {'background-color': "#cccccc"}
                };

                var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions,maxLevel: 2});
                editor.setForm($('#frmEdit'));
                editor.setUpdateButton($('#btnUpdate'));
                editor.setData(arrayjson);

                $('#btnReload').on('click', function () {
                    editor.setData(arrayjson);
                });

                $('#btnOutput').on('click', function () {
                    var load = document.getElementById("loader");
                    load.style.display="block"
                    var str = editor.getString();
                    // cart axios code
                        
                      
                        const formdata = new FormData();
                      formdata.append("menuId",<?= $menuInfo->id ?>); 
                      formdata.append("content",str); 
                      axios.post("<?= base_url('admin/updatedMenu')?>", formdata).then(function (response) {
                                console.log(response.data);
                                load.style.display="none";
                        })
                        .catch((error) => console.log(error));
                    // cart axios code

                    // $("#out").text(str);

                });

                $("#btnUpdate").click(function(){
                    editor.update();
                });

                $('#btnAdd').click(function(){
                    editor.add();
                });
                /* ====================================== */

                /** PAGE ELEMENTS **/
                $('[data-toggle="tooltip"]').tooltip();
                $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
                    $('#btnStars').html(data.stargazers_count);
                    $('#btnForks').html(data.forks_count);
                });
            });
        </script>
        
</body>
</html>
