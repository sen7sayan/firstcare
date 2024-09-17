<?php 
    include_once("includes/header.php");
    include_once("includes/navbar.php");
 ?>
        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0"><?php echo  $pageinfo->name; ?></h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10 pb-8">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url()?>">Home</a></li>
                        <li><?php echo  $pageinfo->name; ?></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            
            <!-- Start of Page Content -->
           <?php echo $pageinfo->content ?>
        </main>
        <!-- End of Main -->
<?php 
    include_once("includes/footer.php");
 ?>