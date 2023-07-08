 <?php $mainMenu = $this->uri->segment(1);
    $subMenu = $this->uri->segment(2);?>

 <!-- [ navigation menu ] start -->
 <nav class="pcoded-navbar menupos-static  brand-red">
     <div class="navbar-wrapper">
         <div class="navbar-brand header-logo" style="background:#ccc;">
             <a href="<?= site_url('facility') ?>" class="b-brand">

                 &nbsp; <img src="<?= base_url('app_assets/images/logo.png') ?>" height="40px;" />
             </a>
             <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
         </div>
         <div class="navbar-content scroll-div">
             <ul class="nav pcoded-inner-navbar">
                 <!-- <li class="nav-item pcoded-menu-caption">
                     <label>Navigation</label>
                 </li> -->
                 <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item  <?= ($mainMenu == 'facility' ? 'active' : '')  ?> ">
                     <a href="<?= site_url('facility') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
				</li>
                <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item  <?= ($mainMenu == 'facility-shift-manager' ? 'active' : '')  ?> ">
                     <a href="<?=site_url('facility-shift-manager') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Shift Managers</span></a>
                 </li>
				 <li data-username="" class="nav-item  <?= ($mainMenu == 'fc-category'?'active':'')  ?> ">
                     <a href="<?= site_url('facility-fc-category') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Category</span></a>
                 </li>
				 <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item  <?= ($mainMenu == 'facility-jobs' ? 'active' : '')  ?> ">
                     <a href="<?=site_url('facility-jobs') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Jobs</span></a>
				 </li>
				 <li data-username="dashboard" class="nav-item <?=($mainMenu =='facility-facility-transactions'?'active':'')?> ">
                     <a href="<?= site_url('facility-facility-transactions') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Transactions</span></a>
				</li>
				 <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item  <?= ($mainMenu == 'fo-logout' ? 'active' : '')  ?> ">
                     <a href="<?=site_url('facility-logout') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Logout</span></a>
				</li>
             </ul>
         </div>
     </div>
 </nav>
 <!-- [ navigation menu ] end -->