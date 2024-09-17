<style type="text/css">
      .user-order{

      }
      .user-account ul{
         list-style: none;
      }
      .user-account ul li{
          vertical-align: middle;
          height: auto;
          width: auto;
          padding: 9px 1.4em;
          border-left: 3px solid #ededed!important;
      }
      .user-account ul li.active{
         background-color: #ededed ;
         color: #000;
         border-left: 3px solid #000!important;
      }
      .user-account ul li.active > a{
         color: black;
      }
      .user-account ul li a{
          background: transparent;
          color: #b7b7b7;
          border: 0px;
          text-align: left;
          font: 500 20px/30px Montserrat;
          border-radius: 0!important;
          width: fit-content;
       } 
       .user-account ul li a:hover{
         background-color: #ededed ;
         text-decoration: none;
         color: #000;
       }
       .user-account ul li:hover{
         background-color: #ededed ;
         color: #000;
         border-left: 3px solid #000!important;
       }
    </style>
   <div class="bg-light py-4">
      <div class="user-account">
         <ul class="pl-0">
            <li>
               <a href="<?= base_url('my-account')?>" ><i class="fa fa-user mr-2"></i>My Account</a>
            </li>
            <li>
               <a href="<?= base_url('my-orders')?>"><i class="fa fa-shopping-bag mr-2"></i> My Orders</a>
            </li>
            <li>
               <a href="<?= base_url('wishlist-products')?>"><i class="fa fa-heart mr-2"></i>My Wishlist</a>
            </li>
            <li>
               <a href="<?= base_url('my-address-book')?>"><i class="fa fa-book mr-2"></i>My Address Book</a>
            </li>
            
            <li>
               <a href="<?= base_url()?>"><i class="fa fa-phone mr-2"></i>Help & Support</a>
            </li>
            <li>
               <a href="<?= base_url()?>"><i class="fa fa-sign-out mr-2"></i>Logout</a>
            </li>
         </ul>
      </div>
   </div>


<script type="text/javascript">
   $(document).ready(function() {
      // console.log(window.location.href);
      var activeurl = window.location.href 
      // $(".user-account ul li a" ).parent("li" ).css( "background", "yellow" );

      $('.user-account ul li a[href="'+activeurl+'"]').parent('li').addClass('active');
   })
</script>