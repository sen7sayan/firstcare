<style type="text/css">
    .nav-item a{
        cursor: pointer;
    }
</style>
<ul class="nav nav-tabs mb-6" >
    <!-- <li class="nav-item">
        <a onclick="window.location = '<?= base_url('my-account')?>'" class="nav-link">Dashboard</a>
    </li> -->
    <li class="nav-item">
        <a onclick="window.location = '<?= base_url('users/orders')?>'"  class="nav-link">Orders</a>
    </li>
    <li class="nav-item">
        <a onclick="window.location = '<?= base_url('my-account')?>'" class="nav-link">Downloads</a>
    </li>
    <li class="nav-item">
        <a onclick="window.location = '<?= base_url('users/user_addresses')?>'" class="nav-link">Addresses</a>
    </li>
    <li class="nav-item">
        <a onclick="window.location = '<?= base_url('my-account')?>'" class="nav-link">Account details</a>
    </li>
    <li class="nav-item">
        <a onclick="window.location = '<?= base_url('wishlist-products')?>'" class="nav-link">Wishlist</a>
    </li>
    <li class="link-item">
        <a href="<?= base_url('user-logout')?>">Logout</a>
    </li>
</ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
      // console.log(window.location.href);
      var activeurl = window.location.href 
      // $(".user-account ul li a" ).parent("li" ).css( "background", "yellow" );

      $('ul.nav-tabs li a[href="'+activeurl+'"]').addClass('active');
   })
</script>