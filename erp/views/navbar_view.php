 <div class="navbar navbar-inverse set-radius-zero">
  <div class="container">
   <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?=base_url();?>">
     <span style='color:white;font-size:20px'>MUJUR Inventory</span>
    </a>
   </div>

   <div class="left-div">
    <div class="user-settings-wrapper">
     <ul class="nav">

      <li class="dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
       </a>
       <div class="dropdown-menu dropdown-settings">
        <div class="media">
         <a class="media-left" href="#">
          <img src="<?=base_url();?>assets/img/wow.png" alt="" class="img-rounded" />
         </a>
         <div class="media-body">
          <h4 class="media-heading">Gunawan </h4>
          <h5>IT Consultant</h5>

         </div>
        </div>
        <hr />
        <h5><strong>Personal Bio : </strong></h5>
        Day will never end.. Until you stop
        <hr />
        <a href="#" class="btn btn-info btn-sm">Full Profile</a>&nbsp; <a href="#" class="btn btn-danger btn-sm">Logout</a>

       </div>
      </li>

     </ul>
    </div>
   </div>
  </div>
 </div>
 <!-- LOGO HEADER END-->
 <section class="menu-section">
  <div class="container">
   <div class="row">
    <div class="col-md-12">
     <div class="navbar-collapse collapse ">
<!-- MENU START -->	 
<?php 
$load_view=isset($baseFolder)?$baseFolder.'menu_view':'menu_view';
$this->load->view($load_view);
?>
<!-- MENU END -->
      
     </div>
    </div>

   </div>
  </div>
 </section>
 <!-- MENU SECTION END-->