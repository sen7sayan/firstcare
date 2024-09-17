<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= base_url("assets/images/")?>favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
      .bg-yellow{
        background-color: #ffe619;
      }
  </style>
  
</head>
<body>  

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
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
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mt-5 bg-yellow">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= base_url('assets/images/logo.png')?>" class="img-fluid">
                        </div>
                        <form action="<?= base_url('account/adminloginData')?>" class="mt-5" method="post">
                          <div class="form-group">
                            <label for="email">Username:</label>
                            <input type="text" class="form-control" placeholder="Enter Username" name="username">
                          </div>
                          <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" placeholder="Enter password" name="password">
                          </div>
                          <button type="submit" class="btn btn-dark btn-block">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

<?php 
    include_once('includes/footer.php');
?>