 <?php $mainMenu = $this->uri->segment(1);
    $subMenu = $this->uri->segment(2);?>

 <!-- [ navigation menu ] start -->
 <nav class="pcoded-navbar menupos-static  brand-red">
     <div class="navbar-wrapper">
         <div class="navbar-brand header-logo" style="background:#EA7825;">
             <a href="<?= site_url('tv-owner/dashboard') ?>" class="b-brand">

                 &nbsp; 
                 <!-- <img src="<?= base_url('app_assets/images/logo.png') ?>" height="40px;" /> -->
             </a>
             <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
         </div>
         <div class="navbar-content scroll-div">
             <ul class="nav pcoded-inner-navbar">
                 <li class="nav-item pcoded-menu-caption">
                     <label>Navigation</label>
                 </li>
                 <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item  <?= ($mainMenu == 'tv' ? 'active' : '')  ?> ">
                     <a href="<?= site_url('tv-owner/dashboard') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
				</li>
                <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item  <?= ($mainMenu == 'rudra_video_category' ? 'active' : '')  ?> ">
                     <a href="<?=site_url('rudra_video_category') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Video Category </span></a>
                 </li>
				 <li data-username="" class="nav-item  <?= ($mainMenu == 'rudra_video_subcategory'?'active':'')  ?> ">
                     <a href="<?= site_url('rudra_video_subcategory') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Video Sub Category</span></a>
                 </li>
				 <li data-username="" class="nav-item  <?= ($mainMenu == 'rudra_videos'?'active':'')  ?> ">
                     <a href="<?= site_url('rudra_videos') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Manage Video </span></a>
                 </li>
				 <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item  <?= ($mainMenu == 'tv-owner-logout' ? 'active' : '')  ?> ">
                     <a href="<?=site_url('tv-owner-logout') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Logout</span></a>
				</li>
             </ul>
         </div>
     </div>
 </nav>
 <!-- [ navigation menu ] end -->