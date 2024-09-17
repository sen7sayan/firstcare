<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <link rel="icon" href="<?= base_url("assets/images/")?>favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/eh013zvcszv4xplb39q12qswpvqsqf1yc9ml0rt2gv4b8aeq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>  
  <!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  
</head>
<body>
   <div class="container-fluid">
        <div class="row p-4">

          <div class="col-md-12">
            <?php 
                if ($this->session->flashdata('message')) {
                    ?>
                    <div class="alert <?php echo $this->session->flashdata('alrt_class') ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $this->session->flashdata('message') ?>
                    </div>
                    <?php    
                }
            ?>
                
          </div>
          <?php 
            include_once("left-sidebar.php")
           ?>
        

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

    /* HTML: <div class="loader"></div> */
    .loader {
      width: 40px;
      height: 26px;
      --c:no-repeat linear-gradient(#000 0 0);
      background:
        var(--c) 0    100%,
        var(--c) 50%  100%,
        var(--c) 100% 100%;
      background-size:8px calc(100% - 4px);
      position: relative;
    }
    .loader:before {
      content: "";
      position: absolute;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #000;
      left: 0;
      top: 0;
      animation: 
        l3-1 1.5s  linear infinite alternate,
        l3-2 0.75s cubic-bezier(0,200,.8,200) infinite;
    }
    @keyframes l3-1 {
      100% {left:calc(100% - 8px)}
    }
    @keyframes l3-2 {
      100% {top:-0.1px}
    }
</style>  

<div id="loader" class="text-center">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="loader"></div>
    </div>
</div>